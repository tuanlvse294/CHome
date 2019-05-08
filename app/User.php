<?php

namespace App;

use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use Notifiable;
    use \App\CanFillOld;
    use SoftDeletes;
    const ROLES = [
        'admin' => 'Admin',
        'mod' => 'Moderator',
        'user' => 'Người dùng'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_url', 'phone', 'address', 'roles'
    ];
    protected $attributes = [ //default value if not set
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
        return $this->hasMany(Offer::class)->where('accepted', '=', true);
    }

    public function all_offers()
    {
        return $this->hasMany(Offer::class)->withTrashed();
    }

    public function pending_offers()
    {
        return $this->hasMany(Offer::class)->where('accepted', '=', false);
    }

    //get list of premium offers
    public function premium_offers()
    {
        return $this->hasMany(Offer::class)->where('accepted', '=', true)->where(function (Builder $q) {
            $q
                ->orwhere('premium_expire', '>', Carbon::now('Asia/Ho_Chi_Minh'))
                ->orwhere('top_expire', '>', Carbon::now('Asia/Ho_Chi_Minh'))
                ->orwhere('highlight_expire', '>', Carbon::now('Asia/Ho_Chi_Minh'));
        });
    }

    public function non_premium_offers()
    {
        return $this->hasMany(Offer::class)->where('accepted', '=', true)->where('premium_expire', '<', Carbon::now('Asia/Ho_Chi_Minh'))
            ->where('top_expire', '<', Carbon::now('Asia/Ho_Chi_Minh'))
            ->where('highlight_expire', '<', Carbon::now('Asia/Ho_Chi_Minh'));
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function all_notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
    }

    public function new_notifications()
    {
        return $this->all_notifications()->where('seen', '=', false)->orderBy('created_at', 'desc');
    }

    public function has_role($role)
    {
        $roles_arr = json_decode($this->roles);
        return $roles_arr != null && in_array($role, $roles_arr);
    }

    public function add_role($role)
    {
        $roles_arr = json_decode($this->roles);
        $roles_arr[] = $role;
        $this->roles = json_encode($roles_arr);
    }

    //show role in human readable format
    public function roles_str()
    {
        $res = '';
        if ($this->roles != null && $this->roles != 'null') {
            foreach (json_decode($this->roles) as $role) {
                $res = $res . User::ROLES[$role] . ", ";
            }
        }
        return $res;
    }
}
