<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Exam;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class ExamController extends VoyagerBaseController
{

    public function publish(){
        $exam = Exam::where('id', \request("id"))->first();
        $exam->status = $exam->status==1?0:1;
        $exam->save();
        return redirect(route('voyager.exams.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        // Subject::destroy($id);

        $exam = Exam::withTrashed()->findorfail($id);
        $exam->forceDelete();

        return redirect(route('voyager.exams.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }


}

