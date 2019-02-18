<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;
    use \App\CanFillOld;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_url', 'phone', 'address'
    ];
    protected $attributes = [
        'avatar_url' => 'no_avatar.png',
        'phone' => '',
        'address' => ''
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function liked_offers()
    {
        return $this->belongsToMany(Offer::class);

    }
}
