<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;
    use \App\CanFillOld;
    use SoftDeletes;
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
        'address' => '',
        'roles' => '["user"]'
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

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function all_notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
    }

    public function new_notifications()
    {
        return $this->all_notifications()->where('seen', '=', false);
    }

    public function has_role($role)
    {
        $roles_arr = json_decode($this->roles);
        return in_array($role, $roles_arr);
    }

    public function add_role($role)
    {
        $roles_arr = json_decode($this->roles);
        $roles_arr[] = $role;
        $this->roles = json_encode($roles_arr);
    }
}
