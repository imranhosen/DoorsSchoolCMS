<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ItemStore;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ItemStoreController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $itemStore = ItemStore::where('id', \request("id"))->first();
        $itemStore->status = $itemStore->status==1?0:1;
        $itemStore->save();
        return redirect(route('voyager.item-stores.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $itemStore = ItemStore::withTrashed()->findorfail($id);
        $itemStore->forceDelete();

        return redirect(route('voyager.item-stores.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


