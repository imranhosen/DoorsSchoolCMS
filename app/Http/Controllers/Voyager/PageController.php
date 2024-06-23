<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\FrontBannerImage;
use App\Models\FrontCmsPage;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\User;


class PageController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $page = Page::where('id', \request("id"))->first();
        $page->status = $page->status==1?0:1;
        $page->save();
        return redirect(route('voyager.pages.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $page = Page::findorfail($id);
        $page->forceDelete();

        return redirect(route('voyager.pages.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


