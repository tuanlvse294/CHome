<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;

    use \App\CanFillOld;

    protected $fillable = ['title', 'address', 'area', 'price', 'content', 'images', 'city_id', 'district_id'];
    protected $attributes = ['images' => '["no-thumbnail.png"]', 'views' => 0];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function likers()
    {
        return $this->belongsToMany(User::class);
    }

    public function get_icon()
    {
        return json_decode($this->images)[0];
    }
}
