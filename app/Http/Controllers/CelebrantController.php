<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\Celebrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CelebrantController extends Controller
{
    public function index()
    {
        $celebrants = auth()->user()->celebrants()->latest()->get();
        return view('celebrants.index', compact('celebrants'));
    }

    public function create()
    {
        return view('celebrants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'wedding' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);


        $celebrant = auth()->user()->celebrants()->create($validated);

        auth()->user()->logActivity(
            'celebrant_added',
            "Added new celebrant: {$validated['name']}",
            ['celebrant_id' => $celebrant->id]
        );        
        return redirect()->route('celebrants.index')
            ->with('success', 'Celebrant added successfully');
    }

    public function show(Celebrant $celebrant)
    {
        return view('celebrants.show', compact('celebrant'));
    }

    public function edit(Celebrant $celebrant)
    {
        return view('celebrants.edit', compact('celebrant'));
    }

    public function update(Request $request, Celebrant $celebrant)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'wedding' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        $celebrant->update($validated);

        auth()->user()->logActivity(
            'celebrant_updated',
            "Updated celebrant: {$celebrant->name}",
            ['celebrant_id' => $celebrant->id]
        );

        return redirect()->route('celebrants.index')
            ->with('success', 'Celebrant updated successfully');
    }

    public function destroy(Celebrant $celebrant)
    {
        $celebrant->delete();

        return redirect()->route('celebrants.index')
            ->with('success', 'Celebrant deleted successfully');
    }

    // Add this method to the existing CelebrantController
    public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt'
    ]);

    $file = $request->file('csv_file');
    $path = $file->getRealPath();
    
    $data = array_map('str_getcsv', file($path));
    $headers = array_shift($data);

    DB::beginTransaction();
    
    try {
        foreach ($data as $row) {
            $celebrantData = array_combine($headers, $row);
            
            $celebrant = auth()->user()->celebrants()->create([
                'title' => $celebrantData['title'] ?? null,
                'name' => $celebrantData['name'],
                'email' => $celebrantData['email'] ?? null,
                'phone' => $celebrantData['phone'] ?? null,
                'birthday' => !empty($celebrantData['birthday']) ? Carbon::parse($celebrantData['birthday']) : null,
                'wedding' => !empty($celebrantData['wedding']) ? Carbon::parse($celebrantData['wedding']) : null,
                'notes' => $celebrantData['notes'] ?? null,
            ]);

          
        }
        
        DB::commit();
        return redirect()->route('celebrants.index')->with('success', 'Celebrants imported successfully');
        
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('CSV import failed', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Import failed. Please check your CSV format.');
    }
}


    // Add this method to download sample CSV
    public function downloadSample()
    {
        $headers = [
            'title', 'name', 'email', 'phone', 'birthday', 'wedding', 'notes'
        ];
        
        $sampleData = [
            ['Mr.', 'John Doe', 'john@example.com', '1234567890', '1990-01-01', '2020-06-15', 'Sample notes'],
        ];

        $callback = function() use($headers, $sampleData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            foreach ($sampleData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="celebrants-sample.csv"',
        ]);
    }


}
