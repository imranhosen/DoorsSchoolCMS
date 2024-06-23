<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Group extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $disable_export = true;


    public function classes(){
        return $this->belongsTo(Clase::class);
    }

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

    public function contents(){
        return $this->hasOne(Content::class,'group_id');
    }
  /*  public function students(){
        return $this->hasOne(Student::class,'group_id');
    }*/
    public function students(){
        return $this->hasMany(Student::class,'group_id');
    }
}
