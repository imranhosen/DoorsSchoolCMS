<?php
namespace App\Http\Controllers\Voyager;


use App\Models\ExamMark;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class ExamMarksController extends VoyagerBaseController
{

    public function active(){
        $exam = ExamMark::where('id', \request("id"))->first();
        $exam->status = $exam->status==1?0:1;
        $exam->save();
        return redirect(route('voyager.exam-marks.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        // Subject::destroy($id);

        $exam = ExamMark::withTrashed()->findorfail($id);
        $exam->forceDelete();

        return redirect(route('voyager.exam-marks.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }


}

