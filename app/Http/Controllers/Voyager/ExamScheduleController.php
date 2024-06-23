<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ExamSchedule;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class ExamScheduleController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $exam_schedule = ExamSchedule::where('id', \request("id"))->first();
        $exam_schedule->status = $exam_schedule->status==1?0:1;
        $exam_schedule->save();
        return redirect(route('voyager.exam-schedules.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        // Subject::destroy($id);

        $exam_schedule = ExamSchedule::withTrashed()->findorfail($id);
        $exam_schedule->forceDelete();

        return redirect(route('voyager.exam-schedules.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

