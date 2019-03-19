<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'url', 'seen'];
    protected $attributes = ['seen' => false];
}
