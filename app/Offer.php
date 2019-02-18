<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
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
}
