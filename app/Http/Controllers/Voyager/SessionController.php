<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Session;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class SessionController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $session = Session::where('id', \request("id"))->first();
        $session->status = $session->status==1?0:1;
        $session->save();
        return redirect(route('voyager.sessions.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $session = Session::withTrashed()->findorfail($id);
        //dd($session);
        $session->forceDelete();

        return redirect(route('voyager.sessions.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

