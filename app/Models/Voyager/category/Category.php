<?php

namespace App\Models\Voyager\category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;

class Category extends \TCG\Voyager\Models\Category
{
    use Translatable;
    use SoftDeletes;
    protected $translatable = ['slug', 'name'];
    protected $table = 'categories';
    protected $fillable = ['slug', 'name'];
    protected $dates = ['deleted_at'];
    //public $allow_export_all = true;
    public $disable_export = true;
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

    public function posts()
    {
        return $this->hasMany(Voyager::modelClass('Post'))
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
}
