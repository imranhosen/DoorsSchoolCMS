<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ItemSupplier;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ItemSupplierController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $itemSupplier = ItemSupplier::where('id', \request("id"))->first();
        $itemSupplier->status = $itemSupplier->status==1?0:1;
        $itemSupplier->save();
        return redirect(route('voyager.item-suppliers.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $itemSupplier = ItemSupplier::withTrashed()->findorfail($id);
        $itemSupplier->forceDelete();

        return redirect(route('voyager.item-suppliers.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


