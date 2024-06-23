<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class StaffLeaveRequest extends Model
{
    protected $table = 'staff_leave_request';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $allow_export_all = true;
    //public $disable_export = true;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();

            $model->applied_by = $user->id;
            $model->staff_id = $user->id;
            $start_date = $model->leave_from;
            $end_date = $model->leave_to;
            $total_days = Carbon::parse($end_date)->diffInDays($start_date);
            $model->leave_days = $total_days;

        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });
    }

}
