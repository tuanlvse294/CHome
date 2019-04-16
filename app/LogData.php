<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogData extends Model
{
    protected $fillable = ['value'];
    const REVENUE = 'revenue';

    public static function log($value)
    {
        LogData::query()->create(['value' => json_encode($value)]);
    }

}
