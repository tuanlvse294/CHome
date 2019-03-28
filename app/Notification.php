<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    protected $fillable = ['title', 'url', 'seen'];
    protected $attributes = ['seen' => false];

    public static function makeNotification($title, $url)
    {
        $notification = new Notification;
        $notification->title = $title;
        $notification->url = $url;
        $notification->save();
    }
}
