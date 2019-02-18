<?php

namespace App;

use App\Http\Controllers\FlashToOld;

use Session;


trait  CanFillOld
{
    //helps controllers refill old input value from model in edit page
    public function fill_olds()
    {
        if (!Session::has('errors')){
            FlashToOld::flash_to_olds($this, $this->fillable);
        }

    }
}