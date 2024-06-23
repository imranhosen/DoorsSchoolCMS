<?php

namespace App\Http\Controllers\backEnd\communicate;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use App\Models\ClaseGroup;
use App\Models\ClassTeacher;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\Group;
use App\Models\GroupSubject;
use App\Models\Session;
use App\Models\Staff;
use App\Models\Student;
use App\Models\StudentPromote;
use App\Models\TeacherSubject;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use function Symfony\Component\String\length;


class CommunicationController extends Controller
{

    public function notificationIndex()
    {
        return view('backend.communicate.notification');
    }

    public function examScheduleStore(Request $request)
    {
        //(dd($request->subject_id))->count();
        if (ExamSchedule::where('clase_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->whereIn('date_of_exam', $request->date_of_exam)
            ->whereIn('teacher_subject_id', $request->subject_id)->exists()) {
            return redirect(route('voyager.exam-schedules.index'))->with('message', 'These Schedule Already Created !');
        } else {
            foreach ($request->subject_id as $key => $subject) {
                //  dd($subject);
                $exam_schedule = new ExamSchedule();
                $exam_schedule->teacher_subject_id = $subject;
                $exam_schedule->exam_id = $request->exam_id;
                $exam_schedule->clase_id = $request->class_id;
                $exam_schedule->group_id = $request->group_id;
                $exam_schedule->date_of_exam = $request->date_of_exam[$key];
                $exam_schedule->start_time = $request->start_time[$key];
                $exam_schedule->end_time = $request->end_time[$key];
                $exam_schedule->room_no = $request->room_no[$key];
                $exam_schedule->full_marks = $request->full_marks[$key];
                $exam_schedule->pass_marks = $request->pass_marks[$key];
                //dd($exam_schedule);
                $exam_schedule->save();
            }
            return redirect(route('voyager.exam-schedules.index'))->with('message', 'Exam Schedule Set Successfully');
        }
    }
}



