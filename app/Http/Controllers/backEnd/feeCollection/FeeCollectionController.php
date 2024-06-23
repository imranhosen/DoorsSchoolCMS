<?php

namespace App\Http\Controllers\backEnd\feeCollection;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use App\Models\ExamMark;
use App\Models\FeeGroup;
use App\Models\Feemaster;
use App\Models\FeesDiscount;
use App\Models\Feetype;
use App\Models\GroupSubject;
use App\Models\Income;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentFee;
use App\Models\Subject;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Voyager;
use function Symfony\Component\Mime\Header\all;

class FeeCollectionController extends Controller
{
    public function balanceFeesindex()
    {
        $this->authorize('browse_balance-fees-index');
        //$feeGroups = FeeGroup::where('status', 1)->get();
        $classes = Clase::where('status', 1)->get();
        return view('backend.feesCollection.balance-fees-index', compact('classes'));

    }

    public function studentBalanceFeesSearch(Request $request)
    {


        $student_fees = StudentFee::with('student', 'feeGroup')->where(['clase_id' => $request->class_id,
            'group_id' => $request->group_id])->get();

        $sumAmount = StudentFee::where(['clase_id' => $request->class_id,
            'group_id' => $request->group_id])->sum('amount');
        $sumDiscountAmount = StudentFee::where(['clase_id' => $request->class_id,
            'group_id' => $request->group_id])->sum('amount_discount');
        $sumFine = StudentFee::where(['clase_id' => $request->class_id,
            'group_id' => $request->group_id])->sum('fine');
        $sumPaid = StudentFee::where(['clase_id' => $request->class_id,
            'group_id' => $request->group_id])->sum('paid');
        $sumBalance = ((($sumAmount + $sumFine) - $sumDiscountAmount) - $sumPaid);
        return response()->json(['student_fees' => $student_fees,
            'sumAmount' => $sumAmount,
            'sumDiscountAmount' => $sumDiscountAmount,
            'sumFine' => $sumFine,
            'sumPaid' => $sumPaid,
            'sumBalance' => $sumBalance,
        ]);
    }

    public function studentFeeMasterIndex()
    {
        $this->authorize('browse_student-fee-master');
        $fee_masters = Feemaster::where('status', 1)->get();
        return view('backend.feesCollection.student-fee-master-index', compact('fee_masters'));

    }

    public function studentFeeMasterAssign(Feemaster $fee_master)
    {
        //dd($fee_master);
        $classes = Clase::where('status', 1)->get();
        return view('backend.feesCollection.student-fee-master-assign', compact('classes', 'fee_master'));

    }

    public function fetchStudentForFeeMaster(Request $request)
    {
        // dd($request->all());
        $data['students'] = Student::with('clase', 'group')->where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->where('gender', $request->gender_val)->get();
        return response()->json($data);
    }

    public function studentFeeMasterAssignStore(Request $request)
    {
        foreach ($request->student_ids as $key => $student) {
            $student_fee = new StudentFee();
            $student_fee->student_id = $student;
            $student_fee->session_id = $request->session_id;
            $student_fee->clase_id = $request->clase_id[$key];
            $student_fee->group_id = $request->group_id[$key];
            $student_fee->feemaster_id = $request->feemaster_id;
            $student_fee->feegroup_id = $request->feegroup_id;
            $student_fee->feetype_id = $request->feetype_id;
            $student_fee->amount = $request->amount;
            $student_fee->balance = $request->amount;
            $student_fee->due_date = $request->due_date;
            $student_fee->save();
        }
        return redirect()->back()->with('message', 'Student Fees Master Assigned Successfully !');
        //return redirect(route('voyager.student-attendances.index'))->with('message', 'Student Attendance Saved Successfully');

    }

    public function fetchStudentFee($studentFeeId)
    {

        $data['student_fee'] = StudentFee::find($studentFeeId);
        $data['fee_discounts'] = FeesDiscount::where('status', 1)->get();
        return response()->json($data);
    }

    public function updateStudentFees(Request $request)
    {
        // dd($request->all());
        $paid = $request->amount;
        //dd($balance);
        $status = 1;
        $student_fee = StudentFee::find($request->student_fee_id);
        $student_fee->date = $request->date;
        $balance = ($student_fee->amount) - $paid;
        //$student_fee->amount = $request->amount;
        $student_fee->amount_discount = $request->amount_discount;
        $student_fee->fine = $request->fine;
        $student_fee->payment_mode = $request->payment_mode;
        $student_fee->payment_id = '000' . '' . $student_fee->id;
        $student_fee->description = $request->description;
        $student_fee->status = $status;
        $student_fee->paid = $paid;
        $student_fee->balance = $balance;
        $student_fee->update();
        // in income module
        $income = new Income();
        $income->name = 'Student Fees';
        $income->invoice_no = $student_fee->id;
        $income->date = $request->date;
        $income->amount = $paid;
        $income->description = 'Student Fees Collection';
        $income->save();

        return redirect()->back()->with(['message' => 'Head Income Add & Student Fees Collected Successfully !', 'alert_type' => 'success']);
    }

    public function deleteStudentFees(StudentFee $studentFee)
    {
        $studentFee->payment_mode = '';
        $studentFee->payment_id = '';
        $studentFee->status = 0;
        $studentFee->date = null;
        $studentFee->amount_discount = 0;
        $studentFee->fine = 0;
        $studentFee->paid = 0;
        $studentFee->balance = (($studentFee->amount) - ($studentFee->paid));
        $studentFee->update();
        // in income module
        $id = $studentFee->id;
        $income = Income::where('invoice_no', $id)->firstOrFail();
        $income->forceDelete();
        return redirect()->back()->with(['message' => "Head Income Delete & Student Fees Collection Removed Successfully!", 'alert_type' => 'error']);

    }

    public function searchFeeByIdIndex()
    {
        return view('backend.feesCollection.search-fee-paymentIdIndex');
    }

    public function fetchFeeByPaymentId(Request $request)
    {

        $data['studentFees'] = StudentFee::with('feeGroup', 'feeType', 'session', 'user', 'student')->where('payment_id', $request->payment_id)->get();
        return response()->json($data);
    }

    public function studentDueFeesindex()
    {
        $this->authorize('browse_student-due-fees');
        $feeGroups = FeeGroup::where('status', 1)->get();
        $classes = Clase::where('status', 1)->get();
        return view('backend.feesCollection.student-due-fees-index', compact('feeGroups', 'classes'));
    }

    public function studentDueFeesSearch(Request $request)
    {
        $data['dueFees'] = StudentFee::with('feeGroup', 'feeType', 'session', 'user', 'student')->where(
            ['status' => 0,
                'feegroup_id' => $request->feegroup_id,
                'clase_id' => $request->class_id,
                'group_id' => $request->group_id
            ])->get();
        // $data['fee_discounts'] = FeesDiscount::where('status', 1)->get();
        return response()->json($data);
    }

    public function fetchDueFee($dueFeeId)
    {
        $data['student_fee'] = StudentFee::find($dueFeeId);
        $data['fee_discounts'] = FeesDiscount::where('status', 1)->get();
        return response()->json($data);
    }

    public function collectDueFees(Request $request)
    {
        // dd($request->all());
        $paid = $request->amount;
        //dd($balance);
        $status = 1;
        $student_fee = StudentFee::find($request->student_fee_id);
        $student_fee->date = $request->date;
        $balance = ($student_fee->amount) - $paid;
        //$student_fee->amount = $request->amount;
        $student_fee->amount_discount = $request->amount_discount;
        $student_fee->fine = $request->fine;
        $student_fee->payment_mode = $request->payment_mode;
        $student_fee->payment_id = '000' . '' . $student_fee->id;
        $student_fee->description = $request->description;
        $student_fee->status = $status;
        $student_fee->paid = $paid;
        $student_fee->balance = $balance;
        $student_fee->update();
        return redirect()->back()->with('message', 'Student Due Fees Collected Successfully !');
    }

    public function feesForwardindex()
    {
        $this->authorize('browse_fees-forward-index');
        //$feeGroups = FeeGroup::where('status', 1)->get();
        $classes = Clase::where('status', 1)->get();
        return view('backend.feesCollection.fees-forward-index', compact('classes'));
    }

    public function fetchStudentForFeesForward(Request $request)
    {
        $data['students'] = Student::with('clase', 'group')->where(['class_id' => $request->class_id, 'group_id' => $request->group_id])->get();
        $data['session'] = Session::where('status', 1)->get();
        return response()->json($data);
    }

    public function studentFeesForwardStore(Request $request)
    {
        //dd($request->all());
        $feeType = Feetype::where('fee_name', 'Previous Session Fees')->get('id');
        $feeTypeId = ($feeType[0]['id']);
        $feeGroup = FeeGroup::where('fee_group_name', 'Previous Session')->get('id');
        $feeGroupId = ($feeGroup[0]['id']);
        $feeMaster = Feemaster::where(['fees_type_id' => 4, 'fees_group_id' => 7])->get('id');
        $feeMasterId = ($feeMaster[0]['id']);
        $status = 0;
        if (StudentFee::where(['clase_id' => $request->clase_id,
            'group_id' => $request->group_id,
            'due_date' => $request->due_date])->whereIn('student_id', $request->student_id)->exists()) {
            return redirect(route('voyager.student-fees.index'))->with('message', 'This Students Fees Forward Already Done!');
        } else {
            foreach ($request->student_id as $key => $studentId) {
                if($request->amount != null){
                $student_fee = new StudentFee();
                $student_fee->student_id = $studentId;
                $student_fee->session_id = $request->session_id;
                $student_fee->feemaster_id = $feeMasterId;
                $student_fee->amount = $request->amount[$key];
                $student_fee->balance = $request->amount[$key];
                $student_fee->due_date = $request->due_date;
                $student_fee->status = $status;
                $student_fee->feegroup_id = $feeGroupId;
                $student_fee->feetype_id = $feeTypeId;
                $student_fee->clase_id = $request->clase_id;
                $student_fee->group_id = $request->group_id;
                $student_fee->save();
                }
            }
            return redirect()->back()->with('message', 'Student Previous Session Fees Forward Successfully !');
        }
    }

    public function fetchStudent(Request $request)
    {
        $data['students'] = Student::where(['class_id' => $request->class_id,
            'group_id' => $request->group_id])->get();
        //$data['groups'] = Group::whereIn('id', $groupId)->get(['name', 'id']);
        return response()->json($data);
    }

    public function feesStatementindex()
    {
        $this->authorize('browse_fees-statement-index');
        $classes = Clase::where('status', 1)->get();
        return view('backend.feesCollection.fees-statement-index', compact('classes'));
    }

    public function fetchStudentFees(Request $request)
    {
        $img = " ";
        $tbody = " ";
        $tbody2 = " ";
        $total = " ";
        $students = Student::with('clase', 'group')->where('id', $request->student_id)->get();
        $student_fees = StudentFee::with('feeGroup', 'feeType')->where('student_id', $request->student_id)->get();
        $sumAmount = StudentFee::where('student_id', $request->student_id)->sum('amount');
        $sumDiscountAmount = StudentFee::where('student_id', $request->student_id)->sum('amount_discount');
        $sumFine = StudentFee::where('student_id', $request->student_id)->sum('fine');
        $sumPaid = StudentFee::where('student_id', $request->student_id)->sum('paid');
        $sumBalance = ((($sumAmount + $sumFine) - $sumDiscountAmount) - $sumPaid);
        foreach ($students as $student) {
            $img .= '<div class="col-md-2"><img width="115" height="115" class="round5" src=' . \TCG\Voyager\Facades\Voyager::image($student->student_image) . ' alt="No Image"></div>';
            $tbody .= '<tr>
                                            <th>Name</th>
                                            <td>' . $student->full_name . '</td>
                                            <th>Class Group</th>
                                            <td> ' . $student->clase->name . ' (' . $student->group->name . ')
                                            </td>
                                        </tr>' .
                '<tr>
                                            <th>Father Name</th>
                                            <td>' . $student->father_name . '</td>
                                            <th>Admission Number</th>
                                            <td>' . $student->admission_no . '</td>
                                        </tr>' .
                '<tr>
                                            <th>Mobile Number</th>
                                            <td>' . $student->mobile_number . '</td>
                                            <th>Roll Number</th>
                                            <td>' . $student->roll_number . '</td>
                                        </tr>' .
                '<tr>
                                            <th>Category</th>
                                            <td>' . $student->group->name . '</td>
                                        </tr>';
        }
        foreach ($student_fees as $student_fee) {
            if ($student_fee->status == 0) {
                $status = "<span class='label label-danger'>Unpaid</span>";
            } else {
                $status = "<span class='label label-success'>Paid</span>";
            }
            $tbody2 .= '<tr class="dark-gray odd" role="row">
                                    <td align="left">' . $student_fee->feeGroup->fee_group_name . '</td>
                                    <td align="left">' . $student_fee->feeType->fee_name . '</td>
                                    <td align="left" class="text text-left"> ' . $student_fee->due_date . '</td>
                                    <td align="left" class="text text-left width85">' . $status . '</td>
                                    <td class="text text-right">' . $student_fee->amount . '</td>
                                    <td class="text text-left">' . $student_fee->payment_id . '</td>
                                    <td class="text text-left">' . $student_fee->payment_mode . '</td>
                                    <td class="text text-left">' . $student_fee->date . '</td>
                                    <td class="text text-right">' . $student_fee->amount_discount . '</td>
                                    <td class="text text-right">' . $student_fee->fine . '</td>
                                    <td class="text text-right">' . $student_fee->paid . '</td>
                                    <td class="text text-right">' . $student_fee->balance . '</td>
                                    </tr>';

        }
        $total .= '
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="left" class="text text-left">Grand Total</td>
                                    <td class="text text-right">TK ' . $sumAmount . '</td>
                                    <td class="text text-left"></td>
                                    <td class="text text-left"></td>
                                    <td class="text text-left"></td>

                                    <td class="text text-right">TK ' . $sumDiscountAmount . '</td>
                                    <td class="text text-right">TK ' . $sumFine . '</td>
                                    <td class="text text-right">TK ' . $sumPaid . '</td>
                                    <td class="text text-right">TK ' . $sumBalance . '</td>
                                    <td class="text text-right"></td>';
        return response()->json(['img' => $img,
            'tbody' => $tbody,
            'tbody2' => $tbody2,
            'total' => $total]);
    }


    public function studentFeeIndex()
    {
        $this->authorize('browse_student-fee');
        $classes = Clase::where('status', 1)->get();
        return view('backend.feesCollection.student-fee', compact('classes'));

    }

    public function studentSearch(Request $request)
    {
        $students = Student::where('class_id', $request->class_id)->where('group_id', $request->group_id)->get();
        $classes = Clase::where('status', 1)->get();
        return view('backend.feesCollection.student-search', compact('students', 'classes'));
    }

    public function addStudentFee(Student $student)
    {
        $student_fees = StudentFee::where('student_id', $student->id)->get();
        $sumAmount = StudentFee::where('student_id', $student->id)->sum('amount');
        $sumDiscountAmount = StudentFee::where('student_id', $student->id)->sum('amount_discount');
        $sumFine = StudentFee::where('student_id', $student->id)->sum('fine');
        $sumPaid = StudentFee::where('student_id', $student->id)->sum('paid');
        $sumBalance = ((($sumAmount + $sumFine) - $sumDiscountAmount) - $sumPaid);
        return view('backend.feesCollection.student-fee-add', compact('student_fees', 'student', 'sumAmount', 'sumDiscountAmount', 'sumFine',
            'sumPaid', 'sumBalance'));
    }

    public function feeManagerByUser()
    {
        $this->authorize('browse_fee-manager-by-user');
        $user = Auth::user();
        $role_id = Role::where('name', 'Student')->value('id');
        if (($user->role_id) == $role_id) {
            $group_id = Student::where('id', $user->student_id)->value('group_id');
            $class_id = Student::where('id', $user->student_id)->value('class_id');
            $student_fees = StudentFee::where('student_id', $user->student_id)->get();
            //dd($student_fees);
            $className = Clase::where('id', $class_id)->value('name');
            $subjectId = GroupSubject::where('group_id', $group_id)->pluck('subject_id')->toArray();
            $subjectNames = Subject::whereIn('id', $subjectId)->get('name');
            return view('backend.feesCollection.fee-manager-by-user', compact('subjectNames', 'className', 'student_fees'));
        }
    }

    public function fetchFeeManagerByUser(Request $request)
    {
        $this->authorize('browse_fee-manager-by-user');
        $data['student_fees'] = StudentFee::with('feeGroup', 'feeType','student','session')->where([
            'student_id' => $request->student_id,
            'status' => $request->status])
            ->whereBetween('updated_at', [$request->date1." 00:00:00", $request->date2." 23:59:59"])
            ->get();
        return response()->json($data);
    }

}
