<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Designation;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class DesignationController extends VoyagerBaseController
{

    public function active(){
        $designation = Designation::where('id', \request("id"))->first();
        $designation->status = $designation->status==1?0:1;
        $designation->save();
        return redirect(route('voyager.designations.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $designation = Designation::withTrashed()->findorfail($id);
        $designation->forceDelete();

        return redirect(route('voyager.designations.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


