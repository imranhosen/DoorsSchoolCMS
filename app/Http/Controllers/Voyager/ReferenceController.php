<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Reference;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ReferenceController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $reference = Reference::where('id', \request("id"))->first();
        $reference->status = $reference->status==1?0:1;
        $reference->save();
        return redirect(route('voyager.references.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $reference = Reference::withTrashed()->findorfail($id);
        $reference->forceDelete();

        return redirect(route('voyager.references.index'));

    }

}


