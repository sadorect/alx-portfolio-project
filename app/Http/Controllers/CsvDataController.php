<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CsvData;
use Illuminate\Http\Request;
//use App\Http\Controllers\CsvDataController;
class CsvDataController extends Controller
{
   

public function showUploadForm()
{
    //return view('upload');
}

public function uploadCsv(Request $request)
{
   // $record->user_id = $request->user_id;

    if ($request->hasFile('csv_file')) {
        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $csvData = array_map('str_getcsv', file($path));
        $headers = array_shift($csvData);

        $fillableColumns = ['name', 'email', 'phone', 'birthday', 'wedding'];

        foreach ($csvData as $row) {
            $rowData = array_combine($headers, $row);

            
            // Filter out extra fields
            $rowData = array_intersect_key($rowData, array_flip($fillableColumns));
            
             // Convert date format: DD-MM-YYYY to YYYY-MM-DD
    $rowData['birthday'] = \Carbon\Carbon::createFromFormat('d-m-Y', $rowData['birthday'])->format('Y-m-d');
    // Convert date format for weddingDay if it's not empty
    if (!empty($rowData['wedding'])) {
        $rowData['wedding'] = \Carbon\Carbon::createFromFormat('d-m-Y', $rowData['wedding'])->format('Y-m-d');
    } else{
        $rowData['wedding'] = "1900-01-01";
    }
    

  

             // Check if email is empty
            if (empty($rowData['email'])) {
                $dummyEmail = uniqid() . '@example.com';
                $rowData['email'] = $dummyEmail;
            }

            $rowData['user_id'] = $request->user_id;

            $existingRecord = CsvData::where('email', $rowData['email'])->first();
        
            //Check for existing records by email to avoid duplicates conflict
            if ($existingRecord) {
                // Update existing record
                $existingRecord->update($rowData);
            } else {
                // Create new record
                CsvData::create($rowData);
            }
        }

        return back()->with('success', 'Records uploaded successfully.');
    }

    return back()->with('error', 'Please upload a CSV file.');
    }
}
