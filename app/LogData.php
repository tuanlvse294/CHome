<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogData extends Model
{
    protected $fillable = ['type', 'value'];
    const REVENUE = 'revenue';

    public static function log($type, $value)
    {
        LogData::query()->create(['type' => $type, 'value' => json_encode($value)]);
    }

}
