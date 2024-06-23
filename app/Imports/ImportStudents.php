<?php

namespace App\Imports;

use App\Models\Clase;
use App\Models\Group;
use App\Models\Session;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportStudents implements ToModel, WithHeadingRow
{
   /* private $class_id, $group_id, $session_id;
    public function __construct()
    {
        $this->class_id = Clase::select('id')->get();
        $this->group_id = 4;
       // dd($this->group_id);
        $this->session_id = Session::select('id')->get();
    }*/
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
       // dd($row);

       // $birth_date = Date::excelToDateTimeObject($row['birth_date']);
        //dd($row['admission_date']);
        //$admission_date = Date::excelToDateTimeObject($row['admission_date']);

        //$measurement_date = Date::excelToDateTimeObject($row['measurement_date']);


//        $class_id = $this->class_id->where('id', $row['class_id'])->first();
//        $group_id = $this->group_id->where('id', $row['group_id'])->first();
//        dd($row['group_id']);
        //dd($row['mobile_number']);
//        $session_id = $this->session_id->where('id', $row['session_id'])->first();

        return new Student([
            'id' => $row['id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'roll_number' => $row['roll_number'],
            'gender' => $row['gender'],
            /*'birth_date' => $birth_date,*/
            'birth_date' => $row['birth_date'],
            'religion' => $row['religion'],
            'caste' => $row['caste'],
            'mobile_number' => $row['mobile_number'],
            'email' => $row['email'],
            'admission_date' => $row['admission_date'],
            'student_image' => $row['student_image'],
            'blood_group' => $row['blood_group'],
            'height' => $row['height'],
            'weight' => $row['weight'],
            'father_name' => $row['father_name'],
            'father_number' => $row['father_number'],
            'father_occupation' => $row['father_occupation'],
            'father_image' => $row['father_image'],
            'mother_name' => $row['mother_name'],
            'mother_number' => $row['mother_number'],
            'mother_occupation' => $row['mother_occupation'],
            'mother_image' => $row['mother_image'],
            'guardian' => $row['guardian'],
            'guardian_name' => $row['guardian_name'] ?? NULL,
            'guardian_relation' => $row['guardian_relation'],
            'guardian_email' => $row['guardian_email'],
            'guardian_image' => $row['guardian_image'],
            'guardian_number' => $row['guardian_number'],
            'guardian_occupation' => $row['guardian_occupation'],
            'guardian_address' => $row['guardian_address'],
            /*'ifGuardianAddressIsCurrentAddress' => $row['ifGuardianAddressIsCurrentAddress'],*/
            'current_address' => $row['current_address'],
            'parmanent_address' => $row['parmanent_address'],
            /*'bankAccount_number' => $row['bankAccount_number'],*/
            'bank_name' => $row['bank_name'],
            'ifsc_code' => $row['ifsc_code'],
            'national_id' => $row['national_id'],
            'local_id' => $row['local_id'],
            'rte' => $row['rte'],
            /*'previousCollege_details' => $row['previousCollege_details'],*/
            'note' => $row['note'],
            'class_id' => $row['class_id'],
            'group_id' => $row['group_id'],
            'status' => $row['status'],
            'admission_no' => $row['admission_no'],
            'session_id' => $row['session_id'],
            'parent_id' => $row['parent_id'],
            'old_admission_no' => $row['old_admission_no'],
            'state' => $row['state'],
            'city' => $row['city'],
            'pincode' => $row['pincode'],
            'route_id' => $row['route_id'],
            'school_house_id' => $row['school_house_id'],
            'vehroute_id' => $row['vehroute_id'],
            'hostel_room_id' => $row['hostel_room_id'],
            'adhar_no' => $row['adhar_no'],
            'samagra_id' => $row['samagra_id'],
            /*'measurement_date' => $measurement_date,*/
            'app_key' => $row['app_key'],
            'parent_app_key' => $row['parent_app_key'],
        ]);
    }
}
