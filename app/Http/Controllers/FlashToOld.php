<?php

namespace App\Http\Controllers;
trait FlashToOld
{

    //save model value to old input
    public static function flash_to_olds($model, $keys)
    {
        foreach ($keys as $key) {
            \Session::flash('_old_input.' . $key, $model[$key]);
        }
    }

    public static function flash_to_old($value, $key)
    {
        \Session::flash('_old_input.' . $key, $value);
    }

    //clear all old inputs
    public static function clear_olds()
    {
        \Session::forget('_old_input');
    }
}