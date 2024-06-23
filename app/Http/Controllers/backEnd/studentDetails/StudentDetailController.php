<?php

namespace App\Http\Controllers\backEnd\studentDetails;

use App\Http\Controllers\Controller;
use App\Models\AttendenceType;
use App\Models\Clase;
use App\Models\ClaseGroup;
use App\Models\Group;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class StudentDetailController extends Controller
{

    public function studentReportindex()
    {
        $this->authorize('browse_student-report');
        $classes = Clase::where('status', 1)->get();
        $students = Student::where('status', 1)->get();
        return view('backend.studentDetails.student-report', compact('classes', 'students'));
    }

    public function guardianReportIndex()
    {
        $this->authorize('browse_guardian-report');
        $classes = Clase::where('status', 1)->get();
        $students = Student::where('status', 1)->get();
        return view('backend.studentDetails.guardian-report', compact('classes', 'students'));
    }

    public function studentHistoryIndex()
    {
        $this->authorize('browse_student-history');
        $classes = Clase::where('status', 1)->get();
        $students = Student::where('status', 1)->get();
        return view('backend.studentDetails.student-history', compact('classes', 'students'));
    }

    public function studentDisabledIndex()
    {
        $classes = Clase::where('status', 1)->get();
        $students = Student::where('status', 0)->get();
        return view('backend.studentDetails.disabled-student', compact('classes', 'students'));
    }

    public function fetchStudentReport(Request $request)
    {
        $students = Student::with('group', 'clase');
        $gender = $request->gender_val;
        if ($gender){
            $students = $students->where('gender', $gender);
        }
        $class_id = $request->class_id;
        if ($class_id){
            $students = $students->where('class_id', $class_id);
        }
        $group_id = $request->group_id;
        if ($group_id){
            $students = $students->where('group_id', $group_id);
        }
        $rte_val = $request->rte_val;
        if ($rte_val){
            $students = $students->where('rte', $rte_val);
        }
        $data['students'] = $students->get();
       // dd($data);
        return response()->json($data);
    }

    public function fetchGuardianReport(Request $request)
    {
        $classId = $request->class_id;
        $groupId = $request->group_id;
        $data['students'] = Student::with('group', 'clase')->where('class_id', $classId)->where('group_id', $groupId)->get();
        return response()->json($data);
    }

    public function fetchStudentHistory(Request $request)
    {
        $classId = $request->class_id;
        $sessionYear = $request->session_year;
        $data['students'] = Student::with('session', 'clase')->where('class_id', $classId)->whereYear('admission_date', $sessionYear)->get();
        //dd($data['students']);
        return response()->json($data);
    }

    public function fetchDisabledStudent(Request $request)
    {
        $classId = $request->class_id;
        $groupId = $request->group_id;
        $data['students'] = Student::with('session', 'group', 'clase')->where('status', 0)->where('class_id', $classId)->where('group_id', $groupId)->get();
        return response()->json($data);
    }

    public function studentAttendence()
    {
        $classes = Clase::where('status', 1)->get();
        $students = Student::where('status', 1)->get();
        return view('backend.studentDetails.student-attendence', compact('classes', 'students'));
    }

    public function fetchstudentDataForAttendence(Request $request)
    {
        //dd($request->all());
        $data['classId'] = $request->class_id;
        $data['groupId'] = $request->group_id;
        $data['date'] = $request->date;
        $data['students'] = Student::where('class_id', $data['classId'])->where('group_id', $data['groupId'])->get();
        $data['attendenceTypes'] = AttendenceType::where('status', 1)->get();
        return response()->json($data);
    }

    public function studentAttendenceSave(Request $request)
    {
        //dd($request->all());
        if (StudentAttendance::where('date', $request->date)->whereIn('student_id', $request->students)->exists()) {
            return redirect(route('voyager.student-attendances.index'))->with('message', 'This Students Attendance Already Taken');
        } else {
            foreach ($request->students as $key => $student) {
                $attendanceSave = new StudentAttendance();
                $attendanceSave->student_id = $student;
                $attendanceSave->clase_id = $request->clase_id;
                $attendanceSave->group_id = $request->group_id;
                $attendanceSave->date = $request->date;
                $attendanceSave->atd_type = $request->atdType[$student];
                $attendanceSave->note = $request->note[$key];
                $attendanceSave->save();
            }
            // return redirect()->back();
            return redirect(route('voyager.student-attendances.index'))->with('message', 'Student Attendance Saved Successfully');
        }
    }

    public function searchAttendenceIndex()
    {
        $this->authorize('browse_searchStudentAttendence');
        $classes = Clase::where('status', 1)->get();
        //$students = Student::where('status', 1)->get();
        return view('backend.studentDetails.student-attendance-search', compact('classes'));
    }

    public function fetchAttendenceData(Request $request)
    {
        //dd($request->all());
        $data['classId'] = $request->class_id;
        $data['groupId'] = $request->group_id;
        $data['date'] = $request->date;
        $data['className'] = Clase::where('id', $data['classId'])->get('name');
        $data['groupName'] = Group::where('id', $data['groupId'])->get('name');
        $presents = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 1)->count();
        $data['absent'] = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 2)->count();
        $data['late'] = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 3)->count();
        $data['lateWithExcuse'] = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 4)->count();
        $data['present'] = ($presents + $data['late'] + $data['lateWithExcuse']);
        //dd($data['students']);
        return response()->json($data);
    }


    public function studentIdCardIndex()
    {
        $this->authorize('browse_studentIdCard');
        //$students = Student::where('status', 1)->get();
        $classes = Clase::where('status', 1)->get();
        return view('backend.studentDetails.student-idCard',compact('classes'));
    }
    public function studentIdCardGenerate(Request $request)
    {
        //dd($request->all());
        $classId = $request->class_id;
        $sessionYear = $request->year;
        $students = Student::with('session', 'clase')->where('class_id', $classId)->whereYear('admission_date', $sessionYear)->get();
        //dd($students);
        return view('backend.studentDetails.student-idCardGenerate',compact('students'));

    }

    public function searchAttendenceByUserIndex()
    {
        $this->authorize('browse_student-attendence-by-user');
        return view('backend.studentDetails.student-attendance-search-by-user');
    }
    public function fetchAttendenceDataByUser(Request $request)
    {
        $this->authorize('browse_student-attendence-by-user');
        $user  = Auth::user();
        $date_start = $request->year.'-'.$request->month.'-01';
        $date_end = $request->year.'-'.$request->month.'-31';
        $data['attendences'] = StudentAttendance::with('atdType','clase','group','student')->where('student_id', $user->student_id)
            ->whereBetween('date',[$date_start,$date_end])->get();
        $data['classId'] = $request->month;
        $data['groupId'] = $request->year;
        $data['date'] = $request->date;
        $data['className'] = Clase::where('id', $data['classId'])->get('name');
        $data['groupName'] = Group::where('id', $data['groupId'])->get('name');
        $presents = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 1)->count();
        $data['absent'] = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 2)->count();
        $data['late'] = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 3)->count();
        $data['lateWithExcuse'] = StudentAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 4)->count();
        $data['present'] = ($presents + $data['late'] + $data['lateWithExcuse']);
        //dd($data['students']);
        return response()->json($data);
    }


}



