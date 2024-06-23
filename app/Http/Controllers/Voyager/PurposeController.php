<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Purpose;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class PurposeController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $purpose = Purpose::where('id', \request("id"))->first();
        $purpose->status = $purpose->status==1?0:1;
        $purpose->save();
        return redirect(route('voyager.purposes.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $purpose = Purpose::withTrashed()->findorfail($id);
        $purpose->forceDelete();

        return redirect(route('voyager.purposes.index'));

    }

}


