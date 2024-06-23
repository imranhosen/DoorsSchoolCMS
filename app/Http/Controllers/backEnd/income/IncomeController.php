<?php

namespace App\Http\Controllers\backEnd\income;

use App\Http\Controllers\Controller;

use App\Models\ExamSchedule;

use App\Models\Income;
use App\Models\IncomeHead;
use Illuminate\Http\Request;



class IncomeController extends Controller
{

    public function incomeIndex()
    {
        $this->authorize('browse_search-incomes-index');
        $income_heads = IncomeHead::where('status', 1)->get();
        return view('backend.incomes.search-income-index',compact('income_heads'));
    }
    public function fetchIncome(Request $request)
    {
       // dd($request->all());
        $data['incomes'] = Income::with('incomeHead')->where('income_head_id', $request->income_head_id)->whereBetween('created_at', [$request->date_from, $request->date_to])->get();
        return response()->json($data);
    }
}



