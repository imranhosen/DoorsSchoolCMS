<?php

namespace App\Models;

use App\Policies\ContentPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Content extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['type','class_id','title','group_id'];
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

    public function contenttypes(){

        return $this->belongsTo(ContentType::class,'type');
    }
    public function classes(){

        return $this->belongsTo(Clase::class,'class_id');
    }
    public function groups(){

        return $this->belongsTo(Group::class,'group_id');
    }

}
