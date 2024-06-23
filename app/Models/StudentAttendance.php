<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class StudentAttendance extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $allow_export_all = true;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->id;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });
    }
    public function atdType(){

        return $this->belongsTo(AttendenceType::class,'atd_type');
    }
    public function group(){

        return $this->belongsTo(Group::class,'group_id');
    }
    public function clase(){
        return $this->belongsTo(Clase::class,'clase_id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
}
