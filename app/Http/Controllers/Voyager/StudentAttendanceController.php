<?php
namespace App\Http\Controllers\Voyager;

use App\Models\AttendenceType;
use App\Models\ComplainType;
use App\Models\StudentAttendance;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class StudentAttendanceController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $student_attendence = StudentAttendance::where('id', \request("id"))->first();
        $student_attendence->status = $student_attendence->status==1?0:1;
        $student_attendence->save();
        return redirect(route('voyager.student-attendances.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $student_attendence = StudentAttendance::withTrashed()->findorfail($id);
        $student_attendence->forceDelete();

        return redirect(route('voyager.student-attendances.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


