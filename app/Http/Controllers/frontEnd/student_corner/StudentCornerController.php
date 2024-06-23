<?php

namespace App\Http\Controllers\frontEnd\student_corner;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentType;
use Illuminate\Http\Request;

class StudentCornerController extends Controller
{
    public function routine(){
        $content_type_id = ContentType::where(['content_type'=>'Routine','status'=>1])->value('id');
        $routines = Content::where(['type'=>$content_type_id,'status'=>1])->get();
        //dd($routines);
        return view('frontend.student_corner.routine',compact('routines'));
    }
    public function syllabus(){
        return view('frontend.student_corner.syllabus');
    }
    public function bookList(){
        $content_type_id = ContentType::where(['content_type'=>'Book List','status'=>1])->value('id');
        $book_lists = Content::where(['type'=>$content_type_id,'status'=>1])->get();
        return view('frontend.student_corner.book-list',compact('book_lists'));
    }
    public function examinations(){
        return view('frontend.student_corner.examinations');
    }
    public function dressCode(){
        return view('frontend.student_corner.dress-code');
    }
    public function idLibraryCard(){
        return view('frontend.student_corner.id-card-and-library-card');
    }
    public function feesAndPayment(){
        return view('frontend.student_corner.fees-and-payments');
    }
    public function holidayCalendar(){
        $content_type_id = ContentType::where(['content_type'=>'Holiday Calender','status'=>1])->value('id');
        $calender_lists = Content::where(['type'=>$content_type_id,'status'=>1])->get();
        return view('frontend.student_corner.holiday-calendar',compact('calender_lists'));
    }
    public function academicCalendar(){
        return view('frontend.student_corner.academic-calendar');
    }
    public function policiesGuidelines(){
        return view('frontend.student_corner.policies-and-guidelines');
    }
    public function guidelineParents(){
        return view('frontend.student_corner.guideline-for-parents');
    }
}
