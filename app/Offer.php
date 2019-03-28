<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;

    use \App\CanFillOld;

    protected $fillable = ['title', 'address', 'area', 'price', 'content', 'images', 'city_id', 'district_id', 'front', 'video_url'];
    protected $attributes = ['images' => '["no-thumbnail.png"]', 'views' => 0];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likers()
    {
        return $this->belongsToMany(User::class);
    }

    public function get_icon()
    {
        return json_decode($this->images)[0];
    }

    function jam_read_num_for_vietnamese($num = false)
    {
        $str = '';
        $num = trim($num);
        $arr = str_split($num);
        $count = count($arr);
        $f = number_format($num);
        if ($count < 4) {
            $str = $num;
        } else {
            $r = explode(',', $f);
            switch (count($r)) {
                case 4:
                    $str = $r[0] . ' tỉ';
                    if ((int)$r[1]) {
                        $str .= ' ' . (int)$r[1] . ' triệu';
                    }
                    break;
                case 3:
                    $str = $r[0] . ' triệu';
                    if ((int)$r[1]) {
                        $str .= ' ' . (int)$r[1] . ' ngàn';
                    }
                    break;
                case 2:
                    $str = $r[0] . ' ngàn';
                    if ((int)$r[1]) {
                        $str .= ' ' . (int)$r[1] . ' đồng';
                    }
                    break;
            }
        }
        return ($str);
    }

    public function get_price_vnd()
    {
        return $this->jam_read_num_for_vietnamese($this->price);
    }

    public static function get_premiums()
    {
        $premiums = Offer::query();

        $premiums = $premiums->where('premium_expire', '>', Carbon::now())->orderBy('last_seen')->limit(6)->get();
        foreach ($premiums as $offer) {
            $offer->last_seen = Carbon::now();
            $offer->save();
        }
        return $premiums;
    }
}
