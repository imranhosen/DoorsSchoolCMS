<?php

namespace App\Imports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportStaff implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        $dob = Date::excelToDateTimeObject($row['dob']);
        $doj = Date::excelToDateTimeObject($row['doj']);
        $dol = Date::excelToDateTimeObject($row['dol']);
        //dd($row);

        return new Staff([
            'id' => $row['id'],
            'employee_id' => $row['employee_id'],
            'designation_id' => $row['designation_id'],
            'department_id' => $row['department_id'],
            /*'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],*/
            'full_name' => $row['full_name'],
            'father_name' => $row['father_name'],
            'mother_name' => $row['mother_name'],
            'dob' => $dob,
            'doj' => $doj,
            'contact_no' => $row['contact_no'],
            'emergency_contact_no' => $row['emergency_contact_no'],
            'marital_status' => $row['marital_status'],
            'staff_image' => $row['staff_image'],
            'present_address' => $row['present_address'],
            'permanent_address' => $row['permanent_address'],
            'qualifications' => $row['qualifications'],
            'work_experience' => $row['work_experience'],
            'note' => $row['note'],
            'epf_no' => $row['epf_no'],
            'basic_salary' => $row['basic_salary'],
            'contract_type' => $row['contract_type'],
            'work_shift' => $row['work_shift'],
            'location' => $row['location'],
            /*'casual_leave' => $row['casual_leave'],
            'medical_leave' => $row['medical_leave'],
            'maternity_leave' => $row['maternity_leave'],
            'study_leave' => $row['study_leave'],
            'earned_leave' => $row['earned_leave'],*/
            'account_title' => $row['account_title'],
            'bank_account_no' => $row['bank_account_no'],
            'bank_name' => $row['bank_name'],
            'ifsc_code' => $row['ifsc_code'],
            'bank_branch_name' => $row['bank_branch_name'],
            'facebook' => $row['facebook'],
            'twitter' => $row['twitter'],
            /*'linkedIn' => $row['linkedIn'],*/
            'instragram' => $row['instragram'],
            'staff_email' => $row['staff_email'],
            'gender' => $row['gender'],
            /*'surname' => $row['surname'],
            'password' => $row['password'],*/
            'resume' => $row['resume'],
            'joinning_letter' => $row['joinning_letter'],
            'registration_letter' => $row['registration_letter'],
            'verification_code' => $row['verification_code'],
            'dol' => $dol,
            'role_id' => $row['role_id'],
            'status' => $row['status'],
        ]);
    }
}
