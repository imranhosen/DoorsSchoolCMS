<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class StudentFeeController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $student_fee = StudentFee::where('id', \request("id"))->first();
        $student_fee->status = $student_fee->status==1?0:1;
        $student_fee->save();
        return redirect(route('voyager.student-fees.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $student_fee = StudentFee::withTrashed()->findorfail($id);
        $student_fee->forceDelete();

        return redirect(route('voyager.student-fees.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


