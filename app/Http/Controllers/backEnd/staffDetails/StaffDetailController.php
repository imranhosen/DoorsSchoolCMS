<?php

namespace App\Http\Controllers\backEnd\staffDetails;

use App\Http\Controllers\Controller;
use App\Models\AttendenceType;
use App\Models\Clase;
use App\Models\ClaseGroup;
use App\Models\Group;
use App\Models\Session;
use App\Models\Staff;
use App\Models\StaffIdCard;
use App\Models\StaffLeaveRequest;
use App\Models\StaffPayslip;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StaffAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Role;
use function Psr\Log\alert;


class StaffDetailController extends Controller
{
    public function staffPayrollIndex()
    {
        $roles = Role::all();
        return view('backend.staffDetails.staff-payroll-index', compact('roles'));
    }

    public function fetchStaffByRoleMonthYear(Request $request)
    {
        $data['month'] = $request->month;
        $data['year'] = $request->year;
        $data['staffs'] = Staff::with('designation', 'department', 'role')->where('role_id', $request->role_id)->get();
        $data['payslips'] = StaffPayslip::where('role_id', $request->role_id)->get();
        return response()->json($data);
    }

    public function fetchStaffPayroll(Staff $staff, $month, $year)
    {
        $month1 = ($month-1);
        $attendences = StaffAttendance::where('staff_id', $staff->id)->whereMonth('date',$month1)->get();
        $present = StaffAttendance::where('staff_id', $staff->id)->whereMonth('date',$month1)->whereYear('date',$year)->whereIn('atd_type', [1,3,4])->count();
        $absent = StaffAttendance::where('staff_id', $staff->id)->whereMonth('date',$month1)->whereYear('date',$year)->where('atd_type', 2)->count();
        $leave = StaffLeaveRequest::where('staff_id', $staff->id)->whereMonth('created_at', $month1)->sum('leave_days');

         //dd($present);
        return view('backend.staffDetails.staff-payroll-create', compact('staff', 'month', 'year','attendences','present','absent','month1','leave'));
    }

    public function staffPayrollStore(Request $request)
    {
        //dd($request->all());
        $date = Date('Y-m-d');
        $status = 1;
        if (StaffPayslip::where(['staff_id' => $request->staff_id,
            'month' => $request->month,
            'year' => $request->year,
            'payment_date' => $date])->exists()) {
            return redirect()->back()->with(['message' => "Staff Payroll Already Saved !", 'alert-type' => 'error']);
        } else {
            $staff_payslip = new StaffPayslip();
            $staff_payslip->staff_id = $request->staff_id;
            $staff_payslip->basic = $request->basic;
            $staff_payslip->total_allowance = $request->total_allowance;
            $staff_payslip->total_deduction = $request->total_deduction;
            $staff_payslip->tax = $request->tax;
            $staff_payslip->net_salary = $request->net_salary;
            $staff_payslip->month = $request->month;
            $staff_payslip->year = $request->year;
            $staff_payslip->status = $status;
            $staff_payslip->role_id = $request->role_id;
            $staff_payslip->payment_date = $date;
            $staff_payslip->save();
            //return view('backend.staffDetails.staff-payroll-index')->with('meassage', 'Staff Payroll Stored Successfully!');
            return redirect()->back()->with('message', 'Staff Payroll Stored Successfully!');
        }
    }

    public function staffDirectoryIndex()
    {
        $this->authorize('browse_staff-directory');
        $roles = Role::all();
        $staffs = Staff::all();
        return view('backend.staffDetails.staff-directory-index', compact('roles', 'staffs'));
    }

    public function fetchStaffByRole(Request $request)
    {
        $tbody1 = " ";
        $tbody2 = " ";
        $staffs = Staff::with('designation', 'department', 'role')->where('role_id', $request->role_id)->get();
        foreach ($staffs as $staff) {
            $tbody1 .= ' <tr role="row" class="odd">
                                                <td tabindex="0">' . $staff->id . '</td>
                                                <td>
                                                    <a href="http://kajcc.edu.bd/admin/staff/profile/1">' . $staff->full_name . '</a>
                                                </td>
                                                <td>' . $staff->role->name . '</td>
                                                <td>' . $staff->department->department_name . '</td>
                                                <td>' . $staff->designation->designation_name . '</td>
                                                <td>031-2854600</td>

                                                <td class="pull-right">
                                                    <a href="{{route(\'voyager.staff.show\',$staff->id)}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       title="Show">
                                                        <i class="fa-sharp fa-solid fa-bars"></i>
                                                    </a>
                                                    <a href="{{route(\'voyager.staff.edit\',$staff->id)}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>';
            $tbody2 .= ' <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <div class="panel widget center bgimage"
                                                         style="margin-bottom:0;overflow:hidden;background-image:url(\'http://127.0.0.1:8000/admin/voyager-assets?path=images%2Fwidget-backgrounds%2F01.jpg\');">
                                                        <div class="dimmer"></div>
                                                        <div class="panel-content">
                                                            <i><img width="115" height="115" class="round5"
                                                                    src=' . Voyager::image($staff->staff_image) . '></i><h4>' . $staff->full_name . '</h4>
                                                            <h4>' . $staff->designation->designation_name . '</h4>
                                                            <h4>' . $staff->contact_no . '</h4>
                                                            <h4>' . $staff->department->department_name . '</h4>
                                                            <h4>' . $staff->role->name . '</h4>
                                                            <div class="form-row">
                                                                <a href="{{route(\'voyager.staff.show\',$staff->id)}}"
                                                                   class="btn btn-primary">View</a>
                                                                <a href="{{route(\'voyager.staff.edit\',$staff->id)}}" class="btn btn-primary">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
        }
        return response()->json(['tbody1' => $tbody1, 'tbody2' => $tbody2]);
    }

    public function fetchStaffBySearch(Request $request)
    {
        $tbody1 = " ";
        $tbody2 = " ";
        $staffs = Staff::with('designation', 'department', 'role')->where('full_name', 'LIKE', '%' . $request->search . "%")
            ->orWhere('role_id', 'LIKE', '%' . $request->search . "%")
            ->orWhere('id', 'LIKE', '%' . $request->search . "%")
            ->orWhere('designation_id', 'LIKE', '%' . $request->search . "%")
            ->orWhere('department_id', 'LIKE', '%' . $request->search . "%")
            ->orWhere('dob', 'LIKE', '%' . $request->search . "%")
            ->orWhere('doj', 'LIKE', '%' . $request->search . "%")
            ->orWhere('contact_no', 'LIKE', '%' . $request->search . "%")
            ->orWhere('emergency_contact_no', 'LIKE', '%' . $request->search . "%")
            ->orWhere('marital_status', 'LIKE', '%' . $request->search . "%")
            ->orWhere('present_address', 'LIKE', '%' . $request->search . "%")
            ->orWhere('qualifications', 'LIKE', '%' . $request->search . "%")
            ->orWhere('basic_salary', 'LIKE', '%' . $request->search . "%")
            ->orWhere('account_title', 'LIKE', '%' . $request->search . "%")
            ->orWhere('bank_name', 'LIKE', '%' . $request->search . "%")
            ->orWhere('bank_branch_name', 'LIKE', '%' . $request->search . "%")
            ->orWhere('gender', 'LIKE', '%' . $request->search . "%")
            ->get();
        foreach ($staffs as $staff) {
            $tbody1 .= ' <tr role="row" class="odd">
                                                <td tabindex="0">' . $staff->id . '</td>
                                                <td>
                                                    <a href="http://kajcc.edu.bd/admin/staff/profile/1">' . $staff->full_name . '</a>
                                                </td>

                                                <td>' . $staff->role->name . '</td>
                                                <td>' . $staff->department->department_name . '</td>
                                                <td>' . $staff->designation->designation_name . '</td>
                                                <td>031-2854600</td>

                                                <td class="pull-right">
                                                    <a href="{{route(\'voyager.staff.show\',$staff->id)}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       title="Show">
                                                        <i class="fa-sharp fa-solid fa-bars"></i>
                                                    </a>
                                                    <a href="{{route(\'voyager.staff.edit\',$staff->id)}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>';
            $tbody2 .= ' <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <div class="panel widget center bgimage"
                                                         style="margin-bottom:0;overflow:hidden;background-image:url(\'http://127.0.0.1:8000/admin/voyager-assets?path=images%2Fwidget-backgrounds%2F01.jpg\');">
                                                        <div class="dimmer"></div>
                                                        <div class="panel-content">
                                                            <i><img width="115" height="115" class="round5"
                                                                    src=' . Voyager::image($staff->staff_image) . '></i><h4>' . $staff->full_name . '</h4>
                                                            <h4>' . $staff->designation->designation_name . '</h4>
                                                            <h4>' . $staff->contact_no . '</h4>
                                                            <h4>' . $staff->department->department_name . '</h4>
                                                            <h4>' . $staff->role->name . '</h4>
                                                            <div class="form-row">
                                                                <a href="{{route(\'voyager.staff.show\',$staff->id)}}"
                                                                   class="btn btn-primary">View</a>
                                                                <a href="{{route(\'voyager.staff.edit\',$staff->id)}}" class="btn btn-primary">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
        }
        return response()->json(['tbody1' => $tbody1, 'tbody2' => $tbody2]);
    }

    public function staffAttendence()
    {
        $classes = Clase::where('status', 1)->get();
        $roles = Role::all();
        return view('backend.staffDetails.staff-attendence', compact('classes', 'roles'));
    }

    public function fetchStaffDataForAttendence(Request $request)
    {
        $data['roleId'] = $request->role_id;
        $data['roleName'] = Role::where('id', $data['roleId'])->get('name');
        $data['date'] = $request->date;
        $data['staffs'] = Staff::where('role_id', $data['roleId'])->get();
        return response()->json($data);
    }

    public function staffAttendenceSave(Request $request)
    {
        if (StaffAttendance::where('date', $request->date)->whereIn('staff_id', $request->staffs)->exists()) {
            return redirect(route('voyager.staff-attendances.index'))->with('message', 'This Staff Attendance Already Taken');
        } else {
            foreach ($request->staffs as $key => $staff) {
                $staffAttendanceSave = new StaffAttendance();
                $staffAttendanceSave->staff_id = $staff;
                $staffAttendanceSave->role_id = $request->role_id;
                $staffAttendanceSave->date = $request->date;
                $staffAttendanceSave->atd_type = $request->atdType[$staff];
                $staffAttendanceSave->note = $request->note[$key];
                $staffAttendanceSave->save();
            }
            // return redirect()->back();
            return redirect(route('voyager.staff-attendances.index'))->with('message', 'Staff Attendance Saved Successfully');
        }
    }

    public function searchStaffAttendenceIndex()
    {
        $classes = Clase::where('status', 1)->get();
        //$students = Student::where('status', 1)->get();
        return view('backend.studentDetails.student-attendance-search', compact('classes'));
    }

    public function fetchStaffAttendenceData(Request $request)
    {
        //dd($request->all());
        $data['classId'] = $request->class_id;
        $data['groupId'] = $request->group_id;
        $data['date'] = $request->date;
        $data['className'] = Clase::where('id', $data['classId'])->get('name');
        $data['groupName'] = Group::where('id', $data['groupId'])->get('name');
        $data['present'] = StaffAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 1)->count();
        $data['absent'] = StaffAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 2)->count();
        $data['late'] = StaffAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 3)->count();
        $data['lateWithExcuse'] = StaffAttendance::where('clase_id', $data['classId'])->where('group_id', $data['groupId'])
            ->where('date', $data['date'])->where('atd_type', 4)->count();
        //dd($data['students']);
        return response()->json($data);
    }
    public function teacherList(){
        $this->authorize('browse_teachers');
        $role_id = Role::where('name','Teacher')->value('id');
        $staffs  = Staff::where('role_id', $role_id)->get();
        return view('backend.teachers.teacher-list-index',compact('staffs'));
    }


}



