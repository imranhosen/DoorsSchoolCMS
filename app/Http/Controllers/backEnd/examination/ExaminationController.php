<?php

namespace App\Http\Controllers\backEnd\examination;

use App\Http\Controllers\Controller;
use App\Models\Admitcard;
use App\Models\Certificate;
use App\Models\Clase;
use App\Models\Exam;
use App\Models\ExamGroup;
use App\Models\ExamMark;
use App\Models\ExamSchedule;
use App\Models\ExamStudent;
use App\Models\Grade;
use App\Models\Marksheet;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use function Illuminate\Mail\Mailables\subject;
use function Symfony\Component\String\length;
use Illuminate\Support\Collection;


class ExaminationController extends Controller
{
    public function generateAdmitcardIndex()
    {
        $classes = Clase::where('status', 1)->get();
        $admitcards = Admitcard::where('status', 1)->get();
        $examGroups = ExamGroup::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();
        $sessions = Session::all();

        return view('backend.examination.generate-admitcard-index',
            compact('classes', 'admitcards', 'examGroups', 'sessions', 'sections'));
    }
    public function generateAdmitcard(Request $request)
    {
        foreach ($request->student_ids as $key => $id) {
            $data['students'][$key] = Student::with('clase', 'group', 'session', 'section')->where('id', $id)->first();
            $data['students'][$key]['marks'] = ExamMark::with('subject', 'student', 'clase', 'session')->where('exam_id', $request->exam_id)->where('student_id', $id)->get();
            foreach ($data['students'][$key]['marks'] as $key2 => $id1){
                $data['students'][$key]['marks'][$key2]['ranges'] = ExamSchedule::where('exam_id', $request->exam_id)
                    ->where('teacher_subject_id',$data['students'][$key]['marks'][$key2]->subject->id)->get();
            }

        }
        $data['admitcards'] = Admitcard::where('id', $request->admitcard_id)->get();
       // $admitcard = Admitcard::where('id', $request->admitcard_id)->get();
        $data['schedules'] = ExamSchedule::with('subject')->where('exam_id', $request->exam_id)->get();
        //$schedule = ExamSchedule::with('subject')->where('exam_id', $request->exam_id)->get();
        /*foreach ($admitcard as $key=>$img){
            $data['leftimage'] = Voyager::image($img->left_logo);
        }*/

        $data['rightLogo'] = Voyager::image($data['admitcards'][0]->right_logo);
        $data['bgimage'] = Voyager::image($data['admitcards'][0]->bg_image);
        $data['sign'] = Voyager::image($data['admitcards'][0]->sign);

        return response()->json($data);
    }
    public function studentExamAssign(Exam $exam)
    {
        //dd($exam->name);
        $classes = Clase::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();
        return view('backend.examination.student-exam-group-assign', compact('classes', 'exam', 'sections'));
    }

    public function fetchStudentForExam(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'class_id' => 'required',
            'group_id' => 'required',
            'section_id' => 'required'
        ]);
        // dd($request->all());
        $data['students'] = Student::with('clase', 'group', 'section', 'studentCategory')
            ->where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->where('section_id', $request->section_id)->get();
        return response()->json($data);
    }

    public function studentExamAssignStore(Request $request)
    {
        //dd($request->all());
        if (ExamStudent::where('exam_id', $request->exam_id)->whereIn('student_id', $request->student_ids)->exists()) {
            return redirect()->route('voyager.exams.index')->with(['message' => "This Exam already assigned to these students!", 'alert-type' => 'error']);

        } else {
            foreach ($request->student_ids as $key => $student) {
                if ($student != null) {
                    $student_exam = new ExamStudent();
                    $student_exam->student_id = $student;
                    $student_exam->exam_id = $request->exam_id;
                    $student_exam->status = 1;
                    $student_exam->save();
                }
            }
        }
        return redirect()->route('voyager.exams.index')->with(['message' => "Exam Assigned Successfully !", 'alert-type' => 'success']);
    }

    public function generateMarksheetIndex()
    {
        $classes = Clase::where('status', 1)->get();
        $marksheets = Marksheet::where('status', 1)->get();
        $examGroups = ExamGroup::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();
        $sessions = Session::all();

        return view('backend.examination.generate-marksheet-index',
            compact('classes', 'marksheets', 'examGroups', 'sessions', 'sections'));
    }

    public function fetchExam(Request $request)
    {
        $examGroupId = Exam::where('exam_group_id', $request->examgroup_id)->pluck('id')->toArray();
        $data['exams'] = Exam::whereIn('id', $examGroupId)->get(['name', 'id']);
        return response()->json($data);
    }

    public function fetchStudentForMarksheet(Request $request)
    {
        //dd($request->all());
        $data['students'] = Student::with('clase', 'group', 'section')
            ->where(['class_id' => $request->class_id,
                'group_id' => $request->group_id,
                'section_id' => $request->section_id])->get();
        $data['marksheets'] = Marksheet::where('id', $request->marksheet_id)->get();
        return response()->json($data);
    }

    public function generateMarksheet(Request $request)
    {
        // $students = Student::with('clase','group','session','section')->whereIn('id',$request->student_ids)->get();
        //dd($students);
        foreach ($request->student_ids as $key => $id) {
            $data['students'][$key] = Student::with('clase', 'group', 'session', 'section')->where('id', $id)->first();
            $data['students'][$key]['marks'] = ExamMark::with('subject', 'student', 'clase', 'session')->where('exam_id', $request->exam_id)->where('student_id', $id)->get();
            foreach ($data['students'][$key]['marks'] as $key2 => $id1){
            $data['students'][$key]['marks'][$key2]['ranges'] = ExamSchedule::where('exam_id', $request->exam_id)
                                               ->where('teacher_subject_id',$data['students'][$key]['marks'][$key2]->subject->id)->get();
            }

        }

        $data['marksheets'] = Marksheet::where('id', $request->marksheet_id)->get();
        return response()->json($data);
        //dd($data);
        /*$modal = "";
        $subjects = "";
        $marks = "";
        $max = "";
        $exam_type_id = ExamGroup::where('id', $request->exam_group_id)->value('exam_type_id');
        $grades = Grade::where('exam_type_id', $exam_type_id)->get();
        $exam_marks = ExamMark::with('subject')->where('exam_id', $request->exam_id)->get();
        //dd($exam_marks);
        foreach ($exam_marks as $mark){
            $subjects .='<tr><td valign="top" style="text-align: left;">'.$mark->subject->name.'</td>
                             <td valign="top" style="text-align: center;">100</td>
                             <td valign="top" style="text-align: center;">33</td>
                             <td valign="top" style="text-align: center;">'.$mark->mark.'</td>
                             <td valign="top" style="text-align: center;border-right:1px solid #999;">Distin</td></tr>';

        }
        $students = Student::with('clase', 'group', 'section')->whereIn('id', $request->student_ids)->get();
        $marksheets = Marksheet::where('id', $request->marksheet_id)->get();
        $sessions = Session::where('id', $request->session_id)->get();
        foreach ($students as $key => $student) {
            $modal .= '<div class="modal-dialog modal-lg" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">View Marksheet</h4>
            </div>
            <div class="modal-body" id="certificate_detail">
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="assets/img/s-favican.png">
        <meta http-equiv="X-UA-Compatible" content="">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
        <meta name="theme-color" content="">
        <style type="text/css">
            *{padding: 0; margin:0;}
            .body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}
            .tableone{}
            .tableone td{border:1px solid #000; padding: 5px 0}
            .denifittable th{border-top: 1px solid #999;}
            .denifittable th,
            .denifittable td {border-bottom: 1px solid #999;
                              border-collapse: collapse;border-left: 1px solid #999;}
            .denifittable tr th {padding: 10px 10px; font-weight: bold;}
            .denifittable tr td {padding: 10px 10px; font-weight: bold;}
            .tcmybg {
                background:top center;
                background-size: 100% 100%;
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 0;
            }
        </style>
                    <img src=' . Voyager::image($marksheets[0]->bg_image) . ' class="tcmybg" width="100%" height="100%">
                    <div style="width: 100%; margin: 0 auto; border:1px solid #000; padding: 10px 5px 5px;position: relative;">
                    <img src=' . Voyager::image($marksheets[0]->header_image) . ' width="100%" height="300px;">

            <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                    <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td width="100" valign="top" align="center" style="padding-left: 0px;"></td>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                    <tr>
                                    <td valign="top" style="font-size: 20px;
                                    font-weight: bold; text-align:
                                    center; text-transform: uppercase;">' . $marksheets[0]->exam_name . '</td>
                                            </tr>
                                                                                    <tr><td valign="top" height="5"></td></tr>
                                                                                    <tr>
                                                <td style="text-align: center; font-weight: bold" valign="top">
                                                    ' . $sessions[0]->name . '
                                                </td>
                                            </tr>
                                            </tbody>
                                            </table>
                                </td>
                                <td width="100" valign="top" align="right" style="padding-right: 0px;"></td>
                            </tr>
                        </tbody>
                        </table>
                    </td>
                </tr>
                <tr><td valign="top" height="10"></td></tr>
                <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0" width="100%" class="">
                            <tbody>
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable">
                                        <tbody>
                                        <tr>
                                        <th valign="top" style="text-align: center; text-transform: uppercase;">
                                        Admission No
                                        </th>
                                        <th valign="top" style="text-align: center; text-transform: uppercase; border-right:1px solid #999">
                                        Roll Number
                                        </th>
                                         </tr>
                                        <tr>
                                        <td valign="" style="text-transform: uppercase;text-align: center;">
                                        '.$student->admission_no.'
                                        </td>
                                        <td valign="" style="text-transform: uppercase;text-align: center;">
                                        '.$student->roll_number.'
                                        </td>
                                         </tr>
                                        <tr>
                                        <td valign="top" colspan="5" style="text-align: center; text-transform: uppercase; border:0">
                                         Certificated That
                                         </td>
                                        </tr>
                                       </tbody>
                                    </table>
                                </td>
                                <td width="100" valign="top" align="center" style="padding-left: 5px;">
                             <img src=' . Voyager::image($student->student_image) . ' width="100" height="100">
                                 </td>
                            </tr>
                        </tbody>
                    </table>
                 </td>
            </tr>
                <tr><td valign="top" height="5"></td></tr>
                <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0" width="100%" class="">
                            <tbody>
                                <tr>
                                 <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;">Mr/Ms<span style="padding-left: 30px; font-weight: bold;">'.$student->full_name.'</span></td>
                                </tr>
                                                                                            <tr>
                                    <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> Father / Husband Name<span style="padding-left: 30px; font-weight: bold;">'.$student->father_name.'</span></td>
                                </tr>
                                                                                            <tr>
                                    <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> Mother Name<span style="padding-left: 30px; font-weight: bold;">'.$student->mother_name.'</span></td>
                                </tr>
                                                                                            <tr>
                                    <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> Date Of Birth<span style="padding-left: 30px; font-weight: bold;">'.$student->dob.'</span></td>
                                </tr>
                                                                                            <tr>
                                    <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> Class<span style="padding-left: 30px; font-weight: bold;">'.$student->clase->name.'</span></td>
                                </tr>
                                <tr>
                                    <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> School Name<span style="padding-left: 30px; font-weight: bold;">' . $marksheets[0]->school_name . '</span></td>
                                </tr>
                                <tr>
                                    <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;">Exam Center<span style="text-transform: uppercase; padding-top: 15px; font-weight: bold; padding-bottom: 20px; padding-left: 30px;">' . $marksheets[0]->exam_center . '</span></td>
                                </tr>
                                <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px; line-height: normal;">' . $marksheets[0]->body_text . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center; text-transform: uppercase;">
                                    <tbody>
                                    <tr>
                                        <th valign="middle" width="35%">Subjects</th>
                                        <th valign="middle" style="text-align: center;">Max Marks</th>
                                        <th valign="middle" style="text-align: center;">Min Marks</th>
                                        <th valign="top" style="text-align: center;">Marks Obtained</th>
                                        <th valign="middle" style="border-right:1px solid #999; text-align: center;">Remarks</th>
                                    </tr>
                                    '.$subjects.'
                                    <tr>
                                        <td valign="top" colspan="5" width="20%" style="font-weight: normal; text-align: left; border-right: 1px solid #999;">Grand Total In Words: <span style="text-align: left;font-weight: bold; padding-left: 30px;">Two hundred eighty four</span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="5" width="20%" style="font-weight: normal; text-align: left; border-top:0;border-right: 1px solid #999;">Result<span style="text-align: left;font-weight: bold; padding-left: 30px;">Pass In Second Division</span></td>
                                    </tr>
                                    </tbody></table>
                            </td>
                 </tr>
            </div>
          </div>
        </div>
    </div>';
        }
        return response()->json(['modal'=>$modal]);*/
    }

    public function examScheduleIndex()
    {

        $exams = Exam::Where('status', 1)->get();
        $classes = Clase::where('status', 1)->get();
        return view('backend.examination.examSchedule', compact('classes', 'exams'));
    }

    public function examMarksIndex()
    {
        $classes = Clase::where('status', 1)->get();
        $exams = Exam::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();
        return view('backend.examination.exam_mark_entry', compact('classes', 'exams', 'sessions'));
    }

    public function fetchStudentForMarksEntry(Request $request)
    {
        /*$this->validate($request, [
            'class_id' => 'required',
            'group_id' => 'required',
            'subject_id' => 'required',
            'session_id' => 'required',
            'exam_id' => 'required',
        ]);*/
        $data['students'] = Student::with('clase', 'group')->where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)->get();
        return response()->json($data);
    }

    public function saveStudentMarks(Request $request)
    {
        $this->validate($request, [
            'class_id' => 'required',
            'group_id' => 'required',
            'subject_id' => 'required',
            'session_id' => 'required',
            'exam_id' => 'required',
        ]);
        if (ExamMark::where(['session_id' => $request->session_id,
            'subject_id' => $request->subject_id,
            'exam_id' => $request->exam_id])
            ->whereIn('student_id', $request->student_id)->exists()) {
            return redirect(route('voyager.exam-marks.index'))->with(['message' => "These students marks already entered !", 'alert-type' => 'error']);
        } else {
            foreach ($request->mark as $key => $mark) {
                if ($mark != null) {
                    $marks = new ExamMark();
                    $marks->mark = $mark;
                    $marks->clase_id = $request->class_id;
                    $marks->group_id = $request->group_id;
                    $marks->subject_id = $request->subject_id;
                    $marks->session_id = $request->session_id;
                    $marks->exam_id = $request->exam_id;
                    $marks->student_id = $request->student_id[$key];
                    $marks->save();
                } else {
                    return redirect(route('voyager.exam-marks.index'))->with(['message' => "Students Marks Entry Successfully Saved !", 'alert-type' => 'success']);
                }
            }
        }
    }

    public function examScheduleStore(Request $request)
    {
        $date = array_values($request->date_of_exam);
        //dd($date);
        $start_time = array_values($request->start_time);
        $end_time = array_values($request->end_time);
        for ($i = 0; $i < (count($date) - 1); $i++) {
            //dd($date[$i + 2]);
            /*if ($date[$i + 1] === $date[$i]) {*/
            if (Carbon::parse($date[$i + 1])->equalTo(Carbon::parse($date[$i]))) {
                //  dd('hi');
                if ($start_time[$i + 1] >= $start_time[$i] && $start_time[$i + 1] <= $end_time[$i]) {
                    return redirect()->back()->with(['message' => "Time could not be same in similiar date !", 'alert-type' => 'error']);
                } else {
                    foreach ($request->start_time as $key => $st_time) {
                        if ($st_time != null) {
                            $start_time_array = $st_time;
                            $end_time_array = $request->end_time[$key];
                            if ($start_time_array == $end_time_array) {
                                return redirect()->back()->with(['message' => "Start time & End time could not be same!", 'alert-type' => 'error']);
                            }
                        }
                    }
                }
            }
            /*   foreach ($request->end_time as $key => $end_time) {
                   if ($end_time != null) {
                       $end_time_array = $end_time;
                       $start_time_array = $request->start_time[$key + 1];
                       //dd($start_time_array);
                       if ($start_time_array == $end_time_array) {
                           return redirect()->back()->with(['message' => "Different Subject End time & Start time  could not be same!", 'alert-type' => 'error']);
                       }
                   }
               }*/
            if (ExamSchedule::whereIn('date_of_exam', $request->date_of_exam)
                ->whereIn('room_no', $request->room_no)
                ->whereBetween('start_time', [$request->start_time, $request->end_time])
                ->whereBetween('end_time', [$request->start_time, $request->end_time])
                ->exists()) {
                return redirect(route('voyager.exam-schedules.index'))->with(['message' => "These Exam Schedule Already Created !", 'alert-type' => 'error']);
            } else {
                foreach ($request->subject_id as $key => $subject) {
                    //  dd($subject);
                    if ($request->start_time[$key] != null) {
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
                }
                return redirect(route('voyager.exam-schedules.index'))->with('message', 'Exam Schedule Set Successfully');
            }
        }
    }
    /*$date = ['2023-04-12', '2023-04-12', '2023-04-13'];
      dd(count($date));
      $start_time = ['10:00:00', '14:00:00', '08:00:00'];
      $end_time = ['12:00:00', '16:00:00', '10:00:00'];

// create an empty array to store the result

      $result = [];

// loop through the arrays

      for ($i = 0; $i < count($date); $i++) {

// check if the date values are the same
          if ($date[$i] === $date[$i - 1]) {

// check if the second index start_time value is between the first index start_time and end_time
              if ($start_time[$i] >= $start_time[$i - 1] && $start_time[$i] <= $end_time[$i - 1]) {

// add the result to the array
                  $result[] = ['date' => $date[$i],
                               'start_time' => $start_time[$i],
                               'end_time' => $end_time[$i]
                  ];
              }
          }
      }

// output the result

      print_r($result);*/

    //(dd($request->subject_id))->count();
//        $exams = [
//            [
//                'date' => ($request->date_of_exam),
//                'start_time' => ($request->start_time),
//                'end_time' => ($request->end_time)
//            ],
//            /*[
//                'date' => '2023-04-11',
//                'start_time' => '10:00',
//                'end_time' => '11:00'
//            ],
//            [
//                'date' => '2023-04-12',
//                'start_time' => '09:00',
//                'end_time' => '10:00'
//            ],*/
//        ];
//
//        // group exams by date
//
//        $grouped = collect($exams)->groupBy('date');
//       //dd($grouped);
//
//       // check start and end times for each group
//
//        foreach ($grouped as $date => $exams) {
//
//            $startTimes = $exams->pluck('start_time')->unique();
//            dd($startTimes);
//
//            $endTimes = $exams->pluck('end_time')->unique();
//
//
//            if ($startTimes->count() == $endTimes->count()) {
//
//               // echo "All exams on $date have different start and end times.\n";
//                dd('hi');
//            }
//            else
//            {
//
//                //echo "There are exams on $date with the same start and end times.\n";
//                dd('hello');
//            }
//        }
    /* $len = array($request->subject_id);
     dd($len);*/
    /*   foreach ($request->end_time as $key => $end_time) {
           if ($request->room_no[$key] != null) {
               $date1 = Carbon::createFromFormat('Y-m-d', $request->date_of_exam[$key]);
               $date2 = Carbon::createFromFormat('Y-m-d', $request->date_of_exam[$key + 1]);
               // dd($date2);
               $result = $date1->equalTo($date2);
               if ($result == true) {
                   //dd('hi');
                   $start_time_array = Carbon::createFromTimeString($request->start_time[$key]);
                   //dd($start_time_array);
                   $end_time_array = Carbon::createFromTimeString($end_time)->addDay();
                   $start_time_array2 = $request->start_time[$key + 1];
                   if (Carbon::createFromTimeString($start_time_array2)->between($start_time_array, $end_time_array)) {
                       return redirect()->back()->with(['message' => "In same date each subject exam time could not be same!", 'alert-type' => 'error']);
                   }
               }
           }
       }*/
}



