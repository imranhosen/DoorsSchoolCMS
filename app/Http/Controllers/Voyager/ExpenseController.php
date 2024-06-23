<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Expense;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ExpenseController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $expense = Expense::where('id', \request("id"))->first();
        $expense->status = $expense->status==1?0:1;
        $expense->save();
        return redirect(route('voyager.expenses.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $expense = Expense::withTrashed()->findorfail($id);
        $expense->forceDelete();

        return redirect(route('voyager.expenses.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


