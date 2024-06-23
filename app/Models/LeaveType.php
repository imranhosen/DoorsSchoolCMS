<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class LeaveType extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $disable_export = true;

   /* public static function boot()
    {
        $class = get_called_class();
        $class::observe(new UserObserver(2));

        parent::boot();
    }*/

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->email;
            $model->updated_by = $user->email;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->email;
        });
    }
}
