<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Feetype;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class FeeTypeController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $feetype = Feetype::where('id', \request("id"))->first();
        $feetype->status = $feetype->status==1?0:1;
        $feetype->save();
        return redirect(route('voyager.feetypes.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $feetype = Feetype::withTrashed()->findorfail($id);
        $feetype->forceDelete();

        return redirect(route('voyager.feetypes.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


