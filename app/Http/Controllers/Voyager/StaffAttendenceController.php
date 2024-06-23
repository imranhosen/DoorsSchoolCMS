<?php
namespace App\Http\Controllers\Voyager;

use App\Models\LeaveType;
use App\Models\StaffAttendance;
use App\Models\StaffLeaveDetail;
use App\Models\StaffLeaveRequest;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class StaffAttendenceController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $atd = StaffAttendance::where('id', \request("id"))->first();
        $atd->status = $atd->status==1?0:1;
        $atd->save();
        return redirect(route('voyager.staff-attendances.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $atd = StaffAttendance::withTrashed()->findorfail($id);
        $atd->forceDelete();

        return redirect(route('voyager.staff-attendances.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

