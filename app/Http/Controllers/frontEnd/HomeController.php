<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\FrontBannerImage;
use App\Models\FrontCmsNews;
use App\Models\Staff;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
Artisan::call('optimize');

class HomeController extends Controller
{
    public function index(){
         $news = FrontCmsNews::where('status', 1)->get();
        $banner_images = FrontBannerImage::where('status', 1)->get();
        $banner_images2 = FrontBannerImage::where('status', 0)->get();
        $designation_id = Designation::where('designation_name','প্রধান শিক্ষক')->where('status', 1)->value('id');
        $principle = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        $designation_id = Designation::where('designation_name','সহকারি প্রধান')->where('status', 1)->value('id');
       // dd($designation_id);
        $vice_principle = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        $designation_id = Designation::where('designation_name','চেয়ারম্যান')->where('status', 1)->value('id');
        $chairman = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        $videos = Video::where('status', 1)->get();
        //dd($videos);
        //dd(substr($principle, 0, 50).'...' );
        return view('frontend.index',compact('news','banner_images','banner_images2','principle','vice_principle','chairman','videos'));
    }
}
