<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ComplainTypeController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $complain_type = ComplainType::where('id', \request("id"))->first();
        $complain_type->status = $complain_type->status==1?0:1;
        $complain_type->save();
        return redirect(route('voyager.complain-types.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $complain_type = ComplainType::withTrashed()->findorfail($id);
        $complain_type->forceDelete();

        return redirect(route('voyager.complain-types.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


