<?php

namespace App\Http\Controllers;

use App\Models\Celebrant;
use Illuminate\Http\Request;

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

        auth()->user()->celebrants()->create($validated);

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

        return redirect()->route('celebrants.index')
            ->with('success', 'Celebrant updated successfully');
    }

    public function destroy(Celebrant $celebrant)
    {
        $celebrant->delete();

        return redirect()->route('celebrants.index')
            ->with('success', 'Celebrant deleted successfully');
    }
}
