<?php
namespace App\Http\Controllers\Voyager\student_houses;

use App\Models\Grade;
use App\Models\StudentCategory;
use App\Models\StudentHouse;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class StudentHouseController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $house = StudentHouse::where('id', \request("id"))->first();
        $house->status = $house->status==1?0:1;
        $house->save();
        return redirect(route('voyager.student-houses.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $house = StudentHouse::withTrashed()->findorfail($id);
        $house->forceDelete();

        return redirect(route('voyager.student-houses.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

