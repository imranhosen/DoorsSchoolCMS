<?php

namespace App\Http\Controllers\frontEnd\facility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function courses(){
        return view('frontend.facilities.courses');
    }
    public function department(){
        return view('frontend.facilities.department');
    }
    public function scienceLab(){
        return view('frontend.facilities.science_lab');
    }
    public function ictLab(){
        return view('frontend.facilities.ict_lab');
    }
    public function multimediaClassroom(){
        return view('frontend.facilities.multimedia_classroom');
    }
    public function scholarship(){
        return view('frontend.facilities.scholarship');
    }
    public function library(){
        return view('frontend.facilities.library');
    }
}
