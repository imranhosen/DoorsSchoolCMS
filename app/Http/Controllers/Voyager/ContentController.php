<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Content;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ContentController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $content = Content::where('id', \request("id"))->first();
        $content->status = $content->status==1?0:1;
        $content->save();
        return redirect(route('voyager.contents.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $content = Content::withTrashed()->findorfail($id);
        $content->forceDelete();

        return redirect(route('voyager.contents.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


