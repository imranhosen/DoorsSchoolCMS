<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ItemCategory;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ItemCategoryController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $itemCategory = ItemCategory::where('id', \request("id"))->first();
        $itemCategory->status = $itemCategory->status==1?0:1;
        $itemCategory->save();
        return redirect(route('voyager.item-categories.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $itemCategory = ItemCategory::withTrashed()->findorfail($id);
        $itemCategory->forceDelete();

        return redirect(route('voyager.item-categories.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


