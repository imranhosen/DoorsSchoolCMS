<?php
namespace App\Http\Controllers\Voyager;

use App\Models\LeaveType;
use App\Models\StaffLeaveRequest;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class StaffLeaveRequestController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $leave_req = StaffLeaveRequest::where('id', \request("id"))->first();
        $leave_req->status = $leave_req->status==1?0:1;
        $leave_req->save();
        return redirect(route('voyager.staff-leave-request.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $leave_req = StaffLeaveRequest::withTrashed()->findorfail($id);
        $leave_req->forceDelete();

        return redirect(route('voyager.staff-leave-request.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

