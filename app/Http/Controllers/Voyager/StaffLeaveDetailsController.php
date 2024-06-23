<?php
namespace App\Http\Controllers\Voyager;

use App\Models\LeaveType;
use App\Models\StaffLeaveDetail;
use App\Models\StaffLeaveRequest;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class StaffLeaveDetailsController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $leave_det = StaffLeaveDetail::where('id', \request("id"))->first();
        $leave_det->status = $leave_det->status==1?0:1;
        $leave_det->save();
        return redirect(route('voyager.staff-leave-details.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $leave_req = StaffLeaveDetail::findorfail($id);
        $leave_req->forceDelete();

        return redirect(route('voyager.staff-leave-details.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

