<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ItemIssue;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ItemIssueController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $itemIssue = ItemIssue::where('id', \request("id"))->first();
        $itemIssue->status = $itemIssue->status==1?0:1;
        $itemIssue->save();
        return redirect(route('voyager.item-issues.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $itemIssue = ItemIssue::withTrashed()->findorfail($id);
        $itemIssue->forceDelete();

        return redirect(route('voyager.item-issues.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


