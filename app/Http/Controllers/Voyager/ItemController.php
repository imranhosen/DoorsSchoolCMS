<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ItemController extends VoyagerBaseController
{

    public function active()
    {
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $item = Item::where('id', \request("id"))->first();
        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();
        return redirect(route('voyager.items.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {
        $item = Item::withTrashed()->findorfail($id);
        if ($item->item_image != null) {
            $oldFileExists = Storage::disk('public')->exists($item->item_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($item->item_image);
            }
        }
        $item->forceDelete();
        return redirect(route('voyager.items.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


