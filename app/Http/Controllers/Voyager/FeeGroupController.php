<?php
namespace App\Http\Controllers\Voyager;

use App\Models\FeeGroup;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class FeeGroupController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $fee_group = FeeGroup::where('id', \request("id"))->first();
        $fee_group->status = $fee_group->status==1?0:1;
        $fee_group->save();
        return redirect(route('voyager.fee-groups.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $fee_group = FeeGroup::withTrashed()->findorfail($id);
        $fee_group->forceDelete();

        return redirect(route('voyager.fee-groups.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


