<?php

namespace App\Http\Controllers\backEnd\academic;

use App\Http\Controllers\Controller;
use App\Models\BookIssue;
use App\Models\Clase;
use App\Models\ClaseGroup;
use App\Models\ClassTeacher;
use App\Models\Group;
use App\Models\GroupSubject;
use App\Models\Session;
use App\Models\Staff;
use App\Models\Student;
use App\Models\StudentPromote;
use App\Models\TeacherSubject;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Role;


class AcademicController extends Controller
{

    public function timeTableIndex()
    {
        $classes = Clase::where('status', 1)->get();
        return view('backend.academics.classTimeTable', compact('classes'));
    }

    public function saveTimetable(Request $request)
    {
        // dd($request->all());
        foreach ($request->start_time as $key => $st_time) {
            if ($st_time != null) {
                $start_time_array = $st_time;
                $end_time_array = $request->end_time[$key];
                if ($start_time_array == $end_time_array) {
                    return redirect()->back()->with(['message' => "Start time & End time could not be same!", 'alert-type' => 'error']);
                }
            }
        }
        if (Timetable::whereIn('room_no', $request->room)
                      ->whereIn('day_name', $request->day)
                      ->whereIn('start_time', $request->start_time)
                      ->whereIn('end_time', $request->end_time)
                      ->exists())
        {
            return redirect(route('voyager.timetables.index'))
                ->with(['message' => "On these day & time this rooms are booked !", 'alert-type' => 'error']);
        } else {
            foreach ($request->day as $key => $day_name) {
                if($request->start_time[$key] != null){
                $timetable = new Timetable();
                $timetable->day_name = $day_name;
                $timetable->class_id = $request->class_id;
                $timetable->group_id = $request->group_id;
                $timetable->subject_id = $request->subject_id;
                $timetable->start_time = $request->start_time[$key];
                $timetable->end_time = $request->end_time[$key];
                $timetable->room_no = $request->room[$key];
                $timetable->save();
                }
            }
            return redirect(route('voyager.timetables.index'))->with('message', 'Class Timetable Set Successfully');
        }
    }

    public function assignClassTeacherIndex()
    {

        $classes = Clase::where('status', 1)->get();
        $staffs = Staff::where('status', 1)->get();
        return view('backend.academics.assignClassTeacher', compact('classes', 'staffs'));
    }

    public function saveAssignClassTeacher(Request $request)
    {
        //dd($request->all());
        if (ClassTeacher::where(['class_id' => $request->class_id, 'group_id' => $request->group_id])
            ->whereIn('staff_id', $request->teachers)->exists()) {
            return redirect()->back()->with(['message' => "These Class Teacher Already Assigned !", 'alert-type' => 'error']);
        } else {
            foreach ($request->teachers as $key => $teacher) {
                $classTeacher = new ClassTeacher();
                $classTeacher->staff_id = $teacher;
                $classTeacher->class_id = $request->class_id;
                $classTeacher->group_id = $request->group_id;
                $classTeacher->save();
            }
            return redirect(route('voyager.class-teachers.index'))->with('message', 'Class Teacher Assign Successfully');
        }
    }

    public function assignSubjectIndex()
    {

        $classes = Clase::where('status', 1)->get();
        $staffs = Staff::where('status', 1)->get();
        return view('backend.academics.assignSubject', compact('classes', 'staffs'));
    }

    public function saveAssignSubject(Request $request)
    {
        //dd($request->all());
        foreach ($request->subject_id as $key => $subject) {
            $subjectTeacher = new TeacherSubject();
            $subjectTeacher->subject_id = $subject;
            $subjectTeacher->clase_id = $request->class_id;
            $subjectTeacher->group_id = $request->group_id;
            $subjectTeacher->staff_id = $request->staff_id[$key];
            $subjectTeacher->save();
        }
        return redirect()->back();
    }

    public function promoteStudentIndex()
    {

        $classes = Clase::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();
        return view('backend.academics.promoteStudents', compact('classes', 'sessions'));
    }

    public function fetchStudentPromote(Request $request)
    {
        $classId = $request->class_id;
        $groupId = $request->group_id;
        $data['students'] = Student::with('group', 'clase')->where('class_id', $classId)->where('group_id', $groupId)->get();
        return response()->json($data);
    }

    public function savePromoteStudent(Request $request)
    {
        //dd($request->all());
        if (StudentPromote::where('session_id', $request->session_id)->whereIn('student_id', $request->student)->exists()) {
            return redirect(route('voyager.student-promotes.index'))->with(['message' => "These Students Already Promoted !", 'alert-type' => 'error']);
        } else {
            foreach ($request->student as $key => $student) {
                $studentPromote = new StudentPromote();
                $studentPromote->student_id = $student;
                $studentPromote->clase_id = $request->class_id;
                $studentPromote->group_id = $request->group_id;
                $studentPromote->session_id = $request->session_id;
                $studentPromote->result = $request->result[$student];
                $studentPromote->session_status = $request->sessionStatus[$student];
                $studentPromote->save();
            }
            return redirect()->back()->with('message', 'Student Promoted Successfully');
        }
    }

    public function active1()
    {
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $class_teacher = ClassTeacher::where('id', \request("id"))->first();
        $class_teacher->status = $class_teacher->status == 1 ? 0 : 1;
        $class_teacher->save();
        return redirect(route('voyager.class-teachers.index'));
    }

    public function active2()
    {
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $timetable = Timetable::where('id', \request("id"))->first();
        $timetable->status = $timetable->status == 1 ? 0 : 1;
        $timetable->save();
        return redirect(route('voyager.timetables.index'));
    }

    public function active3()
    {
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $teacherSubject = TeacherSubject::where('id', \request("id"))->first();
        $teacherSubject->status = $teacherSubject->status == 1 ? 0 : 1;
        $teacherSubject->save();
        return redirect(route('voyager.teacher-subjects.index'));
    }

    public function active4()
    {
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $studentPromote = StudentPromote::where('id', \request("id"))->first();
        $studentPromote->status = $studentPromote->status == 1 ? 0 : 1;
        $studentPromote->save();
        return redirect(route('voyager.student-promotes.index'));
    }

    public function forceDelete1($id)
    {
        $class_teacher = ClassTeacher::findorfail($id);
        $class_teacher->forceDelete();
        return redirect(route('voyager.class-teachers.index'));

    }

    public function forceDelete2($id)
    {
        $timetable = Timetable::findorfail($id);
        $timetable->forceDelete();
        return redirect(route('voyager.timetables.index'));

    }

    public function forceDelete3($id)
    {
        $teacherSubject = TeacherSubject::findorfail($id);
        $teacherSubject->forceDelete();
        return redirect(route('voyager.teacher-subjects.index'));

    }

    public function forceDelete4($id)
    {
        $studentPromote = StudentPromote::findorfail($id);
        $studentPromote->forceDelete();
        return redirect(route('voyager.student-promotes.index'));

    }

}



