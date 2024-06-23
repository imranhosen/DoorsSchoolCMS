<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Income;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class IncomeController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $income = Income::where('id', \request("id"))->first();
        $income->status = $income->status==1?0:1;
        $income->save();
        return redirect(route('voyager.incomes.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $income = Income::withTrashed()->findorfail($id);
        $income->forceDelete();

        return redirect(route('voyager.incomes.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


