<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\FrontCmsPage;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class FrontCmsPagesController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $page = FrontCmsPage::where('id', \request("id"))->first();
        $page->status = $page->status==1?0:1;
        $page->save();
        return redirect(route('voyager.front-cms-pages.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $page = FrontCmsPage::withTrashed()->findorfail($id);
        $page->forceDelete();

        return redirect(route('voyager.front-cms-pages.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


