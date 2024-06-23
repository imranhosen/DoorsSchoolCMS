<?php
namespace App\Http\Controllers\Voyager\disable_reasons;

use App\Models\DisableReason;
use App\Models\Grade;
use App\Models\StudentCategory;
use App\Models\StudentHouse;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class DisableReasonController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $reason = DisableReason::where('id', \request("id"))->first();
        $reason->status = $reason->status==1?0:1;
        $reason->save();
        return redirect(route('voyager.disable-reasons.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $reason = DisableReason::withTrashed()->findorfail($id);
        $reason->forceDelete();
        return redirect(route('voyager.disable-reasons.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

