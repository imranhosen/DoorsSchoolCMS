<?php

namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\FrontBannerImage;
use App\Models\FrontCmsMediaGallery;
use App\Models\FrontCmsPage;
use App\Models\GalleryVideo;
use App\Models\StudentFee;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use function Laminas\Diactoros\getClientFilename;


class GalleryVideoController extends VoyagerBaseController
{

    public function active()
    {
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $video = GalleryVideo::where('id', \request("id"))->first();
        $video->status = $video->status == 1 ? 0 : 1;
        $video->save();
        return redirect(route('voyager.gallery-videos.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $video = GalleryVideo::withTrashed()->findorfail($id);

        // $images = explode(",", $image->gallery_image);
        //dd($images);
        // $images[] =  $image->gallery_image;
        //dd(getClientFilename($images));
        /*foreach ($images as $image){
            $oldFileExists = Storage::disk('public')->exists($image);
            if ($oldFileExists) {
                Storage::disk('public')->delete($image->featured_image);
            }
        }*/
        /*if ($image->gallery_image != null) {
            $oldFileExists = Storage::disk('public')->exists($image->gallery_image);
            dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($image->gallery_image);
            }
        }*/
        // dd($image->featured_image);
        /*if ($image->featured_image != null) {
            $oldFileExists = Storage::disk('public')->exists($image->featured_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($image->featured_image);
            }
        }*/
        $video->forceDelete();

        return redirect(route('voyager.gallery-videos.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


