<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ExpenseHead;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ExpenseHeadController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $expense_head = ExpenseHead::where('id', \request("id"))->first();
        $expense_head->status = $expense_head->status==1?0:1;
        $expense_head->save();
        return redirect(route('voyager.expense-heads.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $expense_head = ExpenseHead::withTrashed()->findorfail($id);
        $expense_head->forceDelete();

        return redirect(route('voyager.expense-heads.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


