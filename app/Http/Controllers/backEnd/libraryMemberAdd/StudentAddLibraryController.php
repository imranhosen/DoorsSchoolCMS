<?php

namespace App\Http\Controllers\backEnd\libraryMemberAdd;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use App\Models\ClaseGroup;
use App\Models\Group;
use App\Models\GroupSubject;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
class StudentAddLibraryController extends Controller
{

    public function index()
    {
        $this->authorize('browse_student-add-library');
        $classes = Clase::where('status', 1)->get();
        $students = Student::where('status', 1)->get();
        return view('backend.library.student-library-card-add-index', compact('classes', 'students'));
    }
    public function fetchStudentForLibraryCard(Request $request)
    {
        $data['students'] = Student::where(['class_id' => $request->class_id,
                                            'group_id' => $request->group_id])->get();
        return response()->json($data);
    }
    public function fetchStudentLibraryNumber(Student $studentId)
    {
        return response()->json(['student'=>$studentId]);
    }
    public function updateStudentLibraryCard(Request $request)
    {
        //dd($request->all());

        if (!empty($request->library_card_no)) {
            $student = Student::find($request->student_id);
            $student->library_id = $request->library_card_no;
            $student->update();
            return redirect()->back()->with('message', 'Student Add as Library Member Successfully');
        } else {
            $student = Student::find($request->student_id);
            $student->library_id = $request->library_card_no;
            $student->update();
            return redirect()->back()->with(['message' => 'Student Membership Removed Successfully !','alert-type'=>'error']);
        }
    }

    public function showStudent(Request $request)
    {
        $classId = $request->class_id;
        $groupId = $request->group_id;
        $students = Student::where('class_id', $classId)->where('group_id', $groupId)->get();
        $classes = Clase::where('status', 1)->get();
        return view('studentAddLibrary.student_search', compact('students', 'classes'));
    }



    public function fetchGroup(Request $request)
    {
        $groupId = ClaseGroup::where('clase_id', $request->clase_id)->pluck('group_id')->toArray();
        $data['groups'] = Group::whereIn('id', $groupId)->get(['name', 'id']);
        return response()->json($data);
    }

    public function fetchSubject(Request $request)
    {
        $subjectId = GroupSubject::where('group_id', $request->group_id)->pluck('subject_id')->toArray();
        $data['subjects'] = Subject::whereIn('id', $subjectId)->get(['name', 'id']);
        return response()->json($data);
    }

}



