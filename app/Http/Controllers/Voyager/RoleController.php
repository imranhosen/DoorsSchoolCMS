<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Role;


class RoleController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $role = Role::where('id', \request("id"))->first();
        $role->status = $role->status==1?0:1;
        $role->save();
        return redirect(route('voyager.roles.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $role = Role::findorfail($id);
        $role->forceDelete();

        return redirect(route('voyager.student-fees.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


