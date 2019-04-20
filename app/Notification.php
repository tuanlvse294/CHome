<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    protected $fillable = ['title', 'url', 'seen', 'user_id'];
    protected $attributes = ['seen' => false];

    public static function makeNotification($title, $url, $user) //shortcut to make a notification
    {
        $notification = new Notification;
        $notification->title = $title;
        $notification->url = $url;
        $notification->user_id = $user->id;
        $notification->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
