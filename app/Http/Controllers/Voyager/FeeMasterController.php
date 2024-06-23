<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Feemaster;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class FeeMasterController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $fee_master = Feemaster::where('id', \request("id"))->first();
        $fee_master->status = $fee_master->status==1?0:1;
        $fee_master->save();
        return redirect(route('voyager.feemasters.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $fee_master = Feemaster::withTrashed()->findorfail($id);
        $fee_master->forceDelete();

        return redirect(route('voyager.feemasters.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


