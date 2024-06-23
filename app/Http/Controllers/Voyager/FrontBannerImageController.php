<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\FrontBannerImage;
use App\Models\FrontCmsPage;
use App\Models\StudentFee;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class FrontBannerImageController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $image = FrontBannerImage::where('id', \request("id"))->first();
        $image->status = $image->status==1?0:1;
        $image->save();
        return redirect(route('voyager.front-banner-images.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $image = FrontBannerImage::withTrashed()->findorfail($id);
        if ($image->banner_image != null) {
            $oldFileExists = Storage::disk('public')->exists($image->banner_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($image->banner_image);
            }
        }
        $image->forceDelete();

        return redirect(route('voyager.front-banner-images.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


