<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Sms extends Model
{
    use Notifiable;
    public $allow_export_all = true;
    //public $disable_export = true;
    protected $fillable = [
        'name',
        'phone_number'
    ];
    public function routeNotificationForVonage($notification)
    {
        return $this->phone_number;
    }

}
