<?php

namespace App\Http\Controllers\frontEnd\result;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentType;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function scienceResult(){
        $content_type_id = ContentType::where(['content_type'=>'Science Result','status'=>1])->value('id');
        $results = Content::where(['type'=>$content_type_id,'status'=>1])->get();
        return view('frontend.result.science-result',compact('results'));
    }
    public function humanitiesResult(){
        $content_type_id = ContentType::where(['content_type'=>'Humanities Result','status'=>1])->value('id');
        $results = Content::where(['type'=>$content_type_id,'status'=>1])->get();
        return view('frontend.result.humanities-result',compact('results'));
    }
    public function bsResult(){
        $content_type_id = ContentType::where(['content_type'=>'Business Studies Result','status'=>1])->value('id');
        $results = Content::where(['type'=>$content_type_id,'status'=>1])->get();
        return view('frontend.result.bs-result',compact('results'));
    }
    public function commerceResult(){
        $content_type_id = ContentType::where(['content_type'=>'Commerce Result','status'=>1])->value('id');
        $results = Content::where(['type'=>$content_type_id,'status'=>1])->get();
        //dd($results);
        return view('frontend.result.commerce-result',compact('results'));
    }
}
