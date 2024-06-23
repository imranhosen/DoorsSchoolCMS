<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Clase;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Staff;
use App\Models\StaffAttendance;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentFee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;
use TCG\Voyager\Models\User;

class VoyagerController extends BaseVoyagerController
{
    public function index()
    {
        $classes = Clase::where('status', 1)->get();
        $liveDate = Date('m');
        $liveDay = Date('d');
        $student_fee = StudentFee::whereMonth('date', $liveDate)->sum('paid');
        $student_due_fee = StudentFee::whereMonth('date', $liveDate)->where('paid', '==', null)->sum('amount');
        $today_present_student = StudentAttendance::whereDay('date',$liveDay)->whereMonth('date',$liveDate)->whereIn('atd_type',[1,3,4])->count();
        $today_present_staff = StaffAttendance::whereDay('date',$liveDay)->whereMonth('date',$liveDate)->whereIn('atd_type',[1,3,4])->count();
       // dd($student_fee);
        $staff_library_member = Staff::where('library_id', '!=', null)->count();
        $user  = User::all()->count();
        $student_library_member = Student::where('library_id', '!=', null)->count();
        $total_library_member = ($staff_library_member + $student_library_member);
        $income = Income::whereMonth('date', $liveDate)->sum('amount');
        $expense = Expense::whereMonth('date', $liveDate)->sum('amount');
        return Voyager::view('voyager::index',compact('student_fee','total_library_member','income','expense','student_due_fee','user','today_present_student','today_present_staff'));
    }
    public function logout()
    {
        $user = Auth::user();
        if($user->student_id == null){
            Auth::logout();
            return redirect()->route('voyager.login');
        }else{
            Auth::logout();
            return redirect()->route('userLogin');
        }
    }
}
