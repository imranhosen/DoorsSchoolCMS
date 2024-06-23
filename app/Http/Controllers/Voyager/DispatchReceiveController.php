<?php
namespace App\Http\Controllers\Voyager;

use App\Models\DispatchReceive;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class DispatchReceiveController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $dispatch_receive = DispatchReceive::where('id', \request("id"))->first();
        $dispatch_receive->status = $dispatch_receive->status==1?0:1;
        $dispatch_receive->save();
        return redirect(route('voyager.dispatch-receive.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $dispatch_receive = DispatchReceive::withTrashed()->findorfail($id);
        $dispatch_receive->forceDelete();

        return redirect(route('voyager.dispatch-receive.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


