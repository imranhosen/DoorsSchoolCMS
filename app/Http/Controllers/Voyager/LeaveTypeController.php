<?php
namespace App\Http\Controllers\Voyager;

use App\Models\LeaveType;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class LeaveTypeController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $leave_type = LeaveType::where('id', \request("id"))->first();
        $leave_type->status = $leave_type->status==1?0:1;
        $leave_type->save();
        return redirect(route('voyager.leave-types.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {
        $leave_type = LeaveType::withTrashed()->findorfail($id);
        $leave_type->forceDelete();
        return redirect(route('voyager.leave-types.index'));

    }

}

