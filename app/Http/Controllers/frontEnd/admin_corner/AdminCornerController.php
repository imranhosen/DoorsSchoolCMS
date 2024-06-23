<?php

namespace App\Http\Controllers\frontEnd\admin_corner;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\GoverningMember;
use App\Models\Staff;
use App\Models\Voyager\role\Role;
use Illuminate\Http\Request;

class AdminCornerController extends Controller
{
   public function governingBody()
    {
        $designation_id = Designation::where('designation_name', 'চেয়ারম্যান')->where('status', 1)->value('id');
        $chairmans = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        $members = GoverningMember::with('designation')
            ->where('status', 1)
            ->whereNot('designation_id', $designation_id)
            ->get()
            ->sortBy('designation.serial_no');
        return view('frontend.admin_corner.governing_body',compact('chairmans','members'));
    }

    public function chairman()
    {
        $designation_id = Designation::where('designation_name', 'চেয়ারম্যান')->where('status', 1)->value('id');
        $chairman = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        return view('frontend.admin_corner.chairman', compact('chairman'));
    }

    public function chairmanIndex()
    {
        $designation_id = Designation::where('designation_name', 'চেয়ারম্যান')->where('status', 1)->value('id');
        $chairman = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        return view('frontend.admin_corner.chairman_index', compact('chairman'));
    }

    public function principal()
    {
        $designation_id = Designation::where('designation_name', 'প্রধান শিক্ষক')->where('status', 1)->value('id');
        //dd($designation_id);
        $principle = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        //dd($principle);
        return view('frontend.admin_corner.principal', compact('principle'));
    }

    public function principleIndex()
    {
        $designation_id = Designation::where('designation_name', 'প্রধান শিক্ষক')->where('status', 1)->value('id');
        $principle = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        //dd($principle);
        return view('frontend.admin_corner.principle_index', compact('principle'));
    }

    public function vicePrincipal()
    {
        $designation_id = Designation::where('designation_name', 'সহকারি প্রধান')->where('status', 1)->value('id');
        $vice_principle = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        //dd($vice_principle);
        return view('frontend.admin_corner.vice_principal', compact('vice_principle'));
    }

    public function vicePrincipleIndex()
    {
        $designation_id = Designation::where('designation_name', 'সহকারি প্রধান')->where('status', 1)->value('id');
        $vice_principle = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        return view('frontend.admin_corner.vice_principal_index', compact('vice_principle'));
    }

    public function teacherInfo()
    {
        $designation_id = Designation::where('designation_name', 'প্রধান শিক্ষক')->where('status', 1)->value('id');
        $principle = Staff::where('designation_id', $designation_id)->where('status', 1)->get();
        $role_id = Role::where('name', 'Teacher')->value('id');
        $teachers = Staff::with('designation')
            ->where('role_id', $role_id)
            ->where('status', 1)
            ->whereNot('designation_id', $designation_id)
            ->get()
            ->sortBy('designation.serial_no');
        return view('frontend.admin_corner.teacher_info', compact('principle', 'teachers'));
    }

    public function employeeInfo()
    {
        $role_id = Role::where('name', 'Teacher')->value('id');
        $designation_id = Designation::where('designation_name', 'চেয়ারম্যান')->where('status', 1)->value('id');
        $employees = Staff::with('designation')
            ->where('status', 1)
            ->whereNot('role_id', $role_id)
            ->whereNot('designation_id', $designation_id)
            ->get()
            ->sortBy('designation.serial_no');

        // dd($teachers);
        return view('frontend.admin_corner.employee_info',compact('employees'));
    }
}
