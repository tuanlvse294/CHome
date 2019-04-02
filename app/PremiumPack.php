<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumPack extends Model
{
    use \App\CanFillOld;

    public static $TYPES = ["premium" => "Tin đặc biệt", "top" => "Tin top", "highlight" => "Tin nổi bật"];
    protected $fillable = ["price", "days", "info", "type"];

    public function type_str()
    {
        return PremiumPack::$TYPES[$this->type];
    }
}
