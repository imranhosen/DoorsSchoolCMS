<?php
namespace App\Http\Controllers\Voyager;

use App\Models\DispatchSend;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class DispatchSendController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $dispatch_send = DispatchSend::where('id', \request("id"))->first();
        $dispatch_send->status = $dispatch_send->status==1?0:1;
        $dispatch_send->save();
        return redirect(route('voyager.dispatch-send.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $dispatch_send = DispatchSend::withTrashed()->findorfail($id);
        $dispatch_send->forceDelete();

        return redirect(route('voyager.dispatch-send.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


