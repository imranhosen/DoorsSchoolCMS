<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Source;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class SourceController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $source = Source::where('id', \request("id"))->first();
        $source->status = $source->status==1?0:1;
        $source->save();
        return redirect(route('voyager.sources.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $source = Source::withTrashed()->findorfail($id);
        $source->forceDelete();

        return redirect(route('voyager.sources.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


