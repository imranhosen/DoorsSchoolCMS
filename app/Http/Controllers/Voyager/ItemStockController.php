<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ItemStock;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ItemStockController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $itemStock = ItemStock::where('id', \request("id"))->first();
        $itemStock->status = $itemStock->status==1?0:1;
        $itemStock->save();
        return redirect(route('voyager.item-stocks.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $itemStock = ItemStock::withTrashed()->findorfail($id);
        $itemStock->forceDelete();

        return redirect(route('voyager.item-stocks.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


