<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class ClassTopic extends Model
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
    public function clase(){
        return $this->belongsTo(Clase::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
