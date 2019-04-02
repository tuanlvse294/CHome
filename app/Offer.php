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
    protected $attributes = ["images" => '["no-thumbnail.png"]', "views" => 0, ''];

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

    public static function get_premiums($number = 6)
    {
        $premiums = Offer::query();

        $premiums = $premiums->where('accepted', '=', true)->where("premium_expire", ">", Carbon::now('Asia/Ho_Chi_Minh'))->orderBy("last_seen")->limit($number)->get();
        foreach ($premiums as $offer) {
            $offer->last_seen = Carbon::now('Asia/Ho_Chi_Minh');
            $offer->save();
        }
        return $premiums;
    }

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

}
