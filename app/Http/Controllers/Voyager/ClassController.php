<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Clase;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ClassController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $class = Clase::where('id', \request("id"))->first();
        $class->status = $class->status==1?0:1;
        $class->save();
        return redirect(route('voyager.clases.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $class = Clase::withTrashed()->findorfail($id);
        $class->forceDelete();

        return redirect(route('voyager.clases.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


