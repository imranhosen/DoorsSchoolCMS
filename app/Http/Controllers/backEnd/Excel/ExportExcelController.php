<?php

namespace App\Http\Controllers\backEnd\Excel;

use App\Exports\ExportStudents;
use App\Exports\ExportUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function exportExcelFile()
    {
        return Excel::download(new ExportUsers(), 'users.xlsx');
    }
    public function exportExcelFileOfStudent()
    {
        return Excel::download(new ExportStudents(), 'users.xlsx');
    }
}
