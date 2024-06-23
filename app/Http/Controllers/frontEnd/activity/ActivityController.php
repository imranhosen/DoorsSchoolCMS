<?php

namespace App\Http\Controllers\frontEnd\activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function sports(){
        return view('frontend.activities.sports');
    }
    public function culturalProgram(){
        return view('frontend.activities.cultural_program');
    }
    public function excursion(){
        return view('frontend.activities.excursion');
    }
    public function bncc(){
        return view('frontend.activities.bncc');
    }
    public function religiousCeremonies(){
        return view('frontend.activities.religious_ceremonies');
    }
    public function roverScout(){
        return view('frontend.activities.rover_scout');
    }
    public function redCrescent(){
        return view('frontend.activities.red_crescent');
    }
}
