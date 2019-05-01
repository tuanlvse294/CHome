<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;

    use \App\CanFillOld;

    protected $fillable = ["title", "address", "area", "price", "content", "images", "city_id", "district_id", "front", "video_url"];
    protected $attributes = ["images" => '["no-thumbnail.png"]', "views" => 0, 'ads_reach' => 0];

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
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function likers()
    {
        return $this->belongsToMany(User::class)->withTrashed();
    }

    public function get_icon()
    {
        return json_decode($this->images)[0];
    }

    //helper function to convert currency to string
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
            $r = explode(",", $f);
            switch (count($r)) {
                case 4:
                    $str = $r[0] . " tỉ";
                    if ((int)$r[1]) {
                        $str .= " " . (int)$r[1] . " triệu";
                    }
                    break;
                case 3:
                    $str = $r[0] . " triệu";
                    if ((int)$r[1]) {
                        $str .= " " . (int)$r[1] . " ngàn";
                    }
                    break;
                case 2:
                    $str = $r[0] . " ngàn";
                    if ((int)$r[1]) {
                        $str .= " " . (int)$r[1] . " đồng";
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

    //get some premiums to show
    public static function get_premiums($number = 6)
    {
        $premiums = Offer::query();

        $premiums = $premiums->where('accepted', '=', true)->where("premium_expire", ">", Carbon::now('Asia/Ho_Chi_Minh'))->orderBy("last_seen")->limit($number)->get();
        foreach ($premiums as $offer) {
            $offer->last_seen = Carbon::now('Asia/Ho_Chi_Minh'); //save to last seen date
            $offer->save();
        }
        return $premiums;
    }

    //get some top offers to show
    public static function get_top($number = 2)
    {
        $tops = Offer::query();

        $tops = $tops->where('accepted', '=', true)->where("top_expire", ">", Carbon::now('Asia/Ho_Chi_Minh'))->orderBy("last_seen")->limit($number)->get();
        foreach ($tops as $offer) {
            $offer->last_seen = Carbon::now('Asia/Ho_Chi_Minh');
            $offer->save();
        }
        return $tops;
    }

    public function premium_expire_status()
    {
        $left = Carbon::parse($this->premium_expire);
        if ($this->is_premium()) {
            return $left->diffForHumans();
        } else {
            return "Hết hạn";
        }
    }

    public function top_expire_status()
    {
        $left = Carbon::parse($this->top_expire);
        if ($this->is_top()) {
            return $left->diffForHumans();
        } else {
            return "Hết hạn";
        }
    }

    public function highlight_expire_status()
    {
        $left = Carbon::parse($this->highlight_expire);
        if ($this->is_highlight()) {
            return $left->diffForHumans();
        } else {
            return "Hết hạn";
        }
    }

    public function is_highlight()
    {
        return (Carbon::now('Asia/Ho_Chi_Minh')->diffInDays($this->highlight_expire, false) > 0);
    }

    /**
     * @return bool
     */
    public function is_top(): bool
    {
        return Carbon::now('Asia/Ho_Chi_Minh')->diffInDays($this->top_expire, false) > 0;
    }

    /**
     * @return bool
     */
    public function is_premium(): bool
    {
        return Carbon::now('Asia/Ho_Chi_Minh')->diffInDays($this->premium_expire, false) > 0;
    }

    //compare two offer, the smaller distance, more similar they are,
    public function distance(Offer $other)
    {
        $district_distance = $this->district_id == $other->district_id ? 0 : 1;
        $city_distance = $this->city_id == $other->city_id ? 0 : 1;

        $price_ratio = ($this->price + 0.001) / ($other->price + 0.001); //avoid zero division
        $price_distance = max($price_ratio, 1 / $price_ratio) - 1;

        $area_ratio = ($this->area + 0.001) / ($other->area + 0.001);
        $area_distance = max($area_ratio, 1 / $area_ratio) - 1;

        $front_ratio = ($this->front + 0.001) / ($other->front + 0.001);
        $front_distance = max($front_ratio, 1 / $front_ratio) - 1;

        $distance = $city_distance * 40 + $district_distance * 20 + $price_distance * 10 + $area_distance + $front_distance;
        $distance *= 1 + rand(-100, 100) / 1000; //add some noise to make the result more interesting
        return $distance;
    }

    //get recommended offers
    public function similars($number = 6)
    {
        $offers = Offer::all()->where('accepted', '=', true)->sortBy(function (Offer $offer, $key) {
            return $offer->distance($this);
        })->take($number);
//        foreach ($offers as $offer) {
//            var_dump($offer->distance($this));
//        }
        return $offers;
    }

}
