<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class ExamMark extends Model
{
    public $allow_export_all = true;
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->id;
            //$model->updated_by = $user->name;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });
    }
    public function student(){

        return $this->belongsTo(Student::class,'student_id');
    }
    public function subject(){

        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function examType(){

        return $this->belongsTo(Exam::class,'exam_id');
    }
    public function clase(){

        return $this->belongsTo(Clase::class,'clase_id');
    }
    public function session(){

        return $this->belongsTo(Session::class,'session_id');
    }
    public function group(){

        return $this->belongsTo(Group::class,'group_id');
    }
}
