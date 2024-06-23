<?php

namespace App\Http\Controllers\Voyager\online_exams;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use App\Models\Exam;
use App\Models\OnlineExam;
use App\Models\OnlineExamQuestion;
use App\Models\OnlineExamStudent;
use App\Models\Question;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class OnlineExamController extends Controller
{
    public function studentOnlineQuestionAssign(OnlineExam $exam)
    {
        //dd($exam);
        $classes = Clase::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();
        $subjects = Subject::where('status', 1)->get();
        $questions = Question::all()->sortByDesc("id");
        return view('backend.examination.student-online-question-assign', compact('classes', 'exam', 'sections','subjects','questions'));
    }
    public function fetchQuestionForAssignExam(Request $request)
    {
        $questions = Question::with('subject');
        $question_type = $request->question_type;
        if ($question_type){
            $questions = $questions->where('question_type', $question_type);
        }
        $question_level = $request->question_level;
        if ($question_level){
            $questions = $questions->where('question_level', $question_level);
        }
        $subject_id = $request->subject_id;
        if ($subject_id){
            $questions = $questions->where('subject_id', $subject_id);
        }
        $class_id = $request->class_id;
        if ($class_id){
            $questions = $questions->where('clase_id', $class_id);
        }
        $group_id = $request->group_id;
        if ($group_id){
            $questions = $questions->where('group_id', $group_id);
        }
        $section_id = $request->section_id;
        if ($section_id){
            $questions = $questions->where('section_id', $section_id);
        }
        $data['questions'] = $questions->orderBy('id','desc')->get();
        // dd($data);
        return response()->json($data);
    }
    public function studentOnlineExamQuestionAssignStore(Request $request)
    {
        //dd($request->all());
        if (OnlineExamQuestion::where('online_exam_id', $request->online_exam_id)->whereIn('question_id', $request->question_ids)->exists()) {
            return redirect()->route('voyager.online-exam-questions.index')->with(['message' => "These questions already assigned to this online exam!", 'alert-type' => 'error']);

        } else {
            foreach ($request->question_ids as $key => $question) {
                if ($question != null) {
                    $exam_question= new OnlineExamQuestion();
                    $exam_question->question_id = $question;
                    $exam_question->online_exam_id = $request->online_exam_id;
                    $exam_question->question_marks = $request->question_marks[$key];
                    $exam_question->question_neg_marks = $request->question_neg_marks[$key];
                    $exam_question->save();
                }
            }
        }
        return redirect()->route('voyager.online-exam-questions.index')->with(['message' => "Question Assigned Successfully !", 'alert-type' => 'success']);
    }

    public function studentOnlineExamAssign(OnlineExam $exam)
    {
        //dd($exam);
        $classes = Clase::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();
        return view('backend.examination.student-online-exam-assign', compact('classes', 'exam', 'sections'));
    }
    public function studentOnlineExamAssignStore(Request $request)
    {
        //dd($request->all());
        if (OnlineExamStudent::where('online_exam_id', $request->online_exam_id)->whereIn('student_id', $request->student_ids)->exists()) {
            return redirect()->route('voyager.online-exam-students.index')->with(['message' => "This Online Exam already assigned to these students!", 'alert-type' => 'error']);

        } else {
            foreach ($request->student_ids as $key => $student) {
                if ($student != null) {
                    $student_exam = new OnlineExamStudent();
                    $student_exam->student_id = $student;
                    $student_exam->online_exam_id = $request->online_exam_id;
                    $student_exam->status = 1;
                    $student_exam->save();
                }
            }
        }
        return redirect()->route('voyager.online-exam-students.index')->with(['message' => "Online Exam Assigned Successfully !", 'alert-type' => 'success']);
    }
}
