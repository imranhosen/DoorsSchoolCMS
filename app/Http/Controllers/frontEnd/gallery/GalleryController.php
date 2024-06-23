<?php

namespace App\Http\Controllers\frontEnd\gallery;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\FrontCmsMediaGallery;
use App\Models\GalleryVideo;
class GalleryController extends Controller
{
    public function photo(){
        $photos = FrontCmsMediaGallery::where('status', 1)->get();
        return view('frontend.gallery.photo',compact('photos'));
    }
    public function video(){
        $videos = GalleryVideo::where('status', 1)->get();
        return view('frontend.gallery.video',compact('videos'));
    }
    public function alumnai(){
        $alumnai = Event::where(['event_title'=>'Alumnai','status'=>1])->get();
        //dd($alumnai);
        return view('frontend.gallery.alumnai',compact('alumnai'));
    }
    public function independenceIndex(){
        $photos = FrontCmsMediaGallery::where('status', 1)->get();
        $videos = GalleryVideo::where('status', 1)->get();
        return view('frontend.independence_corner.independence',compact('photos','videos'));
    }
}
