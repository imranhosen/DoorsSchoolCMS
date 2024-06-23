<?php

namespace App\Http\Controllers\frontEnd\campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function landArea(){
        return view('frontend.campus.land_area');
    }
    public function infrastructure(){
        return view('frontend.campus.infrastructure');
    }
    public function campusMap(){
        return view('frontend.campus.campus_map');
    }
}
