<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class StaffPayroll extends Model
{
    //use  table
    protected $table = 'staff_payroll';

    // deleted data store in recycle
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $allow_export_all = true;
    //public $disable_export = true;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->name;
            $model->updated_by = $user->name;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->name;
        });
    }
}
