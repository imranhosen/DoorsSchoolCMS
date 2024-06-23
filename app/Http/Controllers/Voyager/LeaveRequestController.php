<?php
namespace App\Http\Controllers\Voyager;

use App\Models\StaffLeaveRequest;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class LeaveRequestController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $leave_request = StaffLeaveRequest::where('id', \request("id"))->first();
        $leave_request->status = $leave_request->status == 1 ? 0 : 1;
        $leave_request->save();
        return redirect(route('voyager.staff-leave-request.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $leave_request = StaffLeaveRequest::withTrashed()->findorfail($id);
        $leave_request->forceDelete();

        return redirect(route('voyager.staff-leave-request.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


