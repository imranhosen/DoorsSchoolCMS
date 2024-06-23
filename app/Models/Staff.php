<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Models\Role;


class Staff extends Model
{
   // protected $table = 'staff';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $allow_export_all = true;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->full_name = $model->first_name . ' ' .  $model->last_name;
            $model->created_by = $user->id;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->full_name = $model->first_name . ' ' .  $model->last_name;
            $model->updated_by = $user->id;
        });
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class,'teacher_subjects','staff_id','subject_id');
    }
    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
