<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class OnlineAdmission extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //public $disable_export = true;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            //$user = Auth::user();
            $model->submitted_by = $model->first_name . ' ' .  $model->last_name;
            $model->full_name = $model->first_name . ' ' .  $model->last_name;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->approved_by = $user->id;
        });
    }
}
