<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class StudentFee extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $allow_export_all = true;
    protected $fillable = ['*'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->collected_by = $user->id;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->recollected_by = $user->id;
        });
    }
    public function feeGroup(){

        return $this->belongsTo(FeeGroup::class,'feegroup_id');
    }
    public function feeMaster(){

        return $this->belongsTo(Feemaster::class,'feemaster_id');
    }
    public function feeType(){

        return $this->belongsTo(Feetype::class,'feetype_id');
    }
    public function session(){

        return $this->belongsTo(Session::class);
    }
    public function user(){

        return $this->belongsTo(User::class,'collected_by');
    }
    public function student(){

        return $this->belongsTo(Student::class);
    }
}
