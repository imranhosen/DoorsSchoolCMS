<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Session extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //public $allow_export_all = true;
    public $disable_export = true;

    protected $fillable = ['name','status','updated_by','created_by'];

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
    public function students(){
        return $this->hasMany(Student::class);
    }
}
