<?php
namespace App\Http\Controllers\Voyager;

use App\Models\GeneralCall;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class GeneralCallController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $general_call = GeneralCall::where('id', \request("id"))->first();
        $general_call->status = $general_call->status==1?0:1;
        $general_call->save();
        return redirect(route('voyager.general-calls.index'));
    }


    public function forceDelete($id)
    {

        $general_call = GeneralCall::withTrashed()->findorfail($id);
        $general_call->forceDelete();

        return redirect(route('voyager.general-calls.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


