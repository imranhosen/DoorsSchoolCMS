<?php

namespace App\Http\Controllers\backEnd\expense;

use App\Http\Controllers\Controller;

use App\Models\ExamSchedule;

use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\Income;
use App\Models\IncomeHead;
use Illuminate\Http\Request;



class ExpenseController extends Controller
{

    public function expenseIndex()
    {
        $this->authorize('browse_search-expenses-index');
        $expense_heads = ExpenseHead::where('status', 1)->get();
        return view('backend.expenses.search-expense-index',compact('expense_heads'));
    }
    public function fetchExpense(Request $request)
    {
       // dd($request->all());
        $data['expenses'] = Expense::with('expenseHead')->where('expense_head_id', $request->expense_head_id)->whereBetween('created_at', [$request->date_from, $request->date_to])->get();
        return response()->json($data);
    }
}



