<?php
// app/Http/Controllers/ExcelImportController.php

namespace App\Http\Controllers;

use App\Imports\ExcelImportClass;
use Illuminate\Http\Request;
use Excel;

class ExcelImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file and other form fields
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'head_id' => 'required',
            'department_id' => 'required',
             // Add validation for other form fields if needed
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Get additional data from the form
        $headId = $request->input('head_id');
        $departmentId = $request->input('department_id');
        // Add more fields as needed

        // Process the Excel file, passing additional data to the import class
        Excel::import(new ExcelImportClass($headId, $departmentId), $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
