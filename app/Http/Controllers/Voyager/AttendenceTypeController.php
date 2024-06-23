<?php
namespace App\Http\Controllers\Voyager;

use App\Models\AttendenceType;
use App\Models\ComplainType;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class AttendenceTypeController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $attendence_type = AttendenceType::where('id', \request("id"))->first();
        $attendence_type->status = $attendence_type->status==1?0:1;
        $attendence_type->save();
        return redirect(route('voyager.attendence-types.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $attendence_type = AttendenceType::withTrashed()->findorfail($id);
        $attendence_type->forceDelete();

        return redirect(route('voyager.attendence-types.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


