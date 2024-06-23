<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $allow_export_all = true;
    protected $guarded = [];
   /* protected $fillable = ['id','first_name','last_name','roll_number','gender',
        'religion','caste','mobile_number','email','admission_date','measurement_date','birth_date',
        'student_image','blood_group','height','weight','father_name','father_number',
        'father_occupation','father_image','mother_name','mother_number','mother_occupation',
        'mother_image','guardian','guardian_name','guardian_relation',
        'guardian_email','guardian_image','guardian_number','guardian_occupation',
        'guardian_address','current_address','parmanent_address','bank_name','bankAccount_number',
        'ifsc_code','national_id','local_id','rte','note','class_id','group_id','status','admission_no',
        'session_id','parent_id','old_admission_no','state','city','pincode','route_id','school_house_id',
        'vehroute_id','hostel_room_id','adhar_no','samagra_id','app_key','parent_app_key'];*/
    //public $disable_export = true;

 /*   protected $fillable = ['first_name','last_name','roll_number','gender',
        'birth_date','religion','caste','mobile_number','email','admission_date',
        'student_image','blood_group','height','weight','father_name','father_number',
        'father_occupation','father_image','mother_name','mother_number','mother_occupation',
        'mother_image','guardian','guardian_name','	guardian_relation',
        'guardian_email','guardian_image','guardian_number','guardian_occupation',
        'guardian_address','current_address','parmanent_address','bankAccount_number',
        '','','','','','','','','','','','',];*/

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->id;
            $model->full_name = $model->first_name.' '.$model->last_name;
            $model->admission_no = "01200".''.$model->id;

        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->id;
            $model->full_name = $model->first_name.' '.$model->last_name;
            $model->admission_no = "01200".''.$model->id;
        });
    }
    public function group(){

        return $this->belongsTo(Group::class,'group_id');
    }
    public function clase(){
        return $this->belongsTo(Clase::class,'class_id');
    }
    public function session(){

        return $this->belongsTo(Session::class);
    }
    public function section(){

        return $this->belongsTo(Section::class);
    }
    public function studentCategory(){

        return $this->belongsTo(StudentCategory::class,'category_id');
    }
    /*public function studentFee(){

        return $this->hasMany(StudentFee::class,'id','student_id');
    }*/
/*    public function groups(){

        return $this->belongsTo(Group::class,'group_id');
    }*/
   /* public function classes(){

        return $this->belongsTo(Clase::class,'class_id');
    }*/
 /*   protected function claseName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->clase?->name,
        );
    }*/
}
