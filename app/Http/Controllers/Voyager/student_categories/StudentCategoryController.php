<?php
namespace App\Http\Controllers\Voyager\student_categories;

use App\Models\Grade;
use App\Models\StudentCategory;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class StudentCategoryController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $category = StudentCategory::where('id', \request("id"))->first();
        $category->status = $category->status==1?0:1;
        $category->save();
        return redirect(route('voyager.student-categories.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $category = StudentCategory::withTrashed()->findorfail($id);
        $category->forceDelete();

        return redirect(route('voyager.student-categories.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

