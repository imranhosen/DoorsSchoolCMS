<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Group;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class GroupController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $group = Group::where('id', \request("id"))->first();
        $group->status = $group->status==1?0:1;
        $group->save();
        return redirect(route('voyager.groups.index'));
    }

    public function forceDelete($id)
    {

        $group = Group::withTrashed()->findorfail($id);
        $group->forceDelete();

        return redirect(route('voyager.groups.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }
}

