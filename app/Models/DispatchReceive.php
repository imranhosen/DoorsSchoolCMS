<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Traits\Translatable;


class DispatchReceive extends Model
{
    protected $table = 'dispatch_receive';
    public $allow_export_all = true;

    use SoftDeletes, Translatable;

    protected $dates = ['deleted_at'];

    protected $translatable = ['name','title', 'body', 'excerpt', 'meta_description', 'meta_keywords', 'seo_title', 'slug'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->id;
            //$model->updated_by = $user->name;
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });
    }

}
