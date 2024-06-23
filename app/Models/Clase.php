<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Clase extends Model
{
   use SoftDeletes;
   protected $dates = ['deleted_at'];
    //public $allow_export_all = true;
    public $disable_export = true;
    //public $disable_import = true;
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

    public  function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function contents(){
        return $this->hasOne(Content::class,'class_id');
    }

    public function students(){
        return $this->hasMany(Student::class,'class_id');
    }
    /*public function student(){
        return $this->hasOne(Student::class,'class_id');
    }*/
   /* public function students(){
        return $this->hasOne(Student::class,'class_id');
    }*/

}
