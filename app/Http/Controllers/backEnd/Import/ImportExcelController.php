<?php

namespace App\Http\Controllers\backEnd\Import;

use App\Http\Controllers\Controller;
use App\Imports\ImportComplains;
use App\Imports\ImportStaff;
use App\Imports\ImportStudents;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function importComplain()
    {
        Excel::import(new ImportComplains(), request()->file('file'));

        return back()->with(['message' => "Successfully imported !", 'alert-type' => 'success']);
    }
    public function importStudent()
    {
        Excel::import(new ImportStudents(), request()->file('file'));

        return back()->with(['message' => "Successfully imported !", 'alert-type' => 'success']);
    }
    public function importStaff()
    {
        Excel::import(new ImportStaff(), request()->file('file'));

        return back()->with(['message' => "Successfully imported !", 'alert-type' => 'success']);
    }
}
