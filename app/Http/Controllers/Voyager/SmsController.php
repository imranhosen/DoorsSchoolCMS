<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Session;
use App\Models\Sms;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class SmsController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $sms = Sms::where('id', \request("id"))->first();
        $sms->status = $sms->status==1?0:1;
        $sms->save();
        return redirect(route('voyager.sms.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $sms = Sms::findorfail($id);
        $sms->forceDelete();

        return redirect(route('voyager.sms.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

