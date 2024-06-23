<?php

namespace App\Http\Controllers\frontEnd\notice_board;

use App\Http\Controllers\Controller;
use App\Models\FrontCmsNews;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
   public function newsView(FrontCmsNews $news){
       //$image = $news->news_image;

       return view('frontend.notice_board.news-index',compact('news'));
   }
   public function newsAllView(){
       $news =  FrontCmsNews::all();
       //dd($news);
       return view('frontend.notice_board.news-all',compact('news'));
   }
}
