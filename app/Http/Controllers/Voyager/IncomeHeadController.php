<?php
namespace App\Http\Controllers\Voyager;

use App\Models\IncomeHead;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class IncomeHeadController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $income_head = IncomeHead::where('id', \request("id"))->first();
        $income_head->status = $income_head->status==1?0:1;
        $income_head->save();
        return redirect(route('voyager.income-heads.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $income_head = IncomeHead::withTrashed()->findorfail($id);
        $income_head->forceDelete();

        return redirect(route('voyager.income-heads.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


