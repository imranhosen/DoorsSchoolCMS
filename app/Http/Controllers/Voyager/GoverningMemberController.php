<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\FrontBannerImage;
use App\Models\FrontCmsMediaGallery;
use App\Models\FrontCmsPage;
use App\Models\GoverningMember;
use App\Models\StudentFee;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use function Laminas\Diactoros\getClientFilename;


class GoverningMemberController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $member = GoverningMember::where('id', \request("id"))->first();
        $member->status = $member->status==1?0:1;
        $member->save();
        return redirect(route('voyager.governing-members.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $image = GoverningMember::withTrashed()->findorfail($id);

        //$images = explode(",", $image->gallery_image);
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
        if ($image->image != null) {
        $oldFileExists = Storage::disk('public')->exists($image->image);
        //dd($oldFileExists);
        if ($oldFileExists) {
            Storage::disk('public')->delete($image->image);
        }
    }
        $image->forceDelete();

        return redirect(route('voyager.governing-members.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


