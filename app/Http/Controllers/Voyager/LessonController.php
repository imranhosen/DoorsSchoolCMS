<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Lesson;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class LessonController extends VoyagerBaseController
{

    public function active(){
        $lesson = Lesson::where('id', \request("id"))->first();
        $lesson->status = $lesson->status==1?0:1;
        $lesson->save();
        return redirect(route('voyager.lessons.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $lesson = Lesson::withTrashed()->findorfail($id);
        $lesson->forceDelete();

        return redirect(route('voyager.lessons.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

