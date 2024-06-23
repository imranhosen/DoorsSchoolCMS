<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Department;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class DepartmentController extends VoyagerBaseController
{

    public function active(){
        $department = Department::where('id', \request("id"))->first();
        $department->status = $department->status==1?0:1;
        $department->save();
        return redirect(route('voyager.departments.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $department = Department::withTrashed()->findorfail($id);
        $department->forceDelete();

        return redirect(route('voyager.departments.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

