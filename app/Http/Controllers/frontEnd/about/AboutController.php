<?php

namespace App\Http\Controllers\frontEnd\about;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
   public function historical(){
       return view('frontend.about_us.historical_outline');
   }
   public function clzCode(){
       return view('frontend.about_us.college_code');
   }
   public function missionVision(){
       return view('frontend.about_us.mission_vision');
   }
   public function atAglance(){
       return view('frontend.about_us.at_a_glance');
   }
   public function facilities(){
       return view('frontend.about_us.facilities');
   }
}
