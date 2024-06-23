<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\FrontBannerImage;
use App\Models\FrontCmsPage;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Category;


class CategoryController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $category = Category::where('id', \request("id"))->first();
        $category->status = $category->status==1?0:1;
        $category->save();
        return redirect(route('voyager.categories.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $category = Category::findorfail($id);
        $category->forceDelete();

        return redirect(route('voyager.categories.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


