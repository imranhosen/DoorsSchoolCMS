<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Traits\Translatable;


class Complain extends Model
{
    use SoftDeletes;
    protected $fillable = ['complain_type_id','source_id','complain_by','phone','description','action_taken','assigned','note','date'];
    //protected $fillable = ['*'];
    //protected $fillable = array('*');
    protected $dates = ['deleted_at'];
    public $allow_export_all = true;

    /*protected $translatable = ['name','title', 'body', 'excerpt', 'meta_description', 'meta_keywords', 'seo_title', 'slug'];*/

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
    public function complain_types(){
        return $this->belongsTo(ComplainType::class);
    }

}
