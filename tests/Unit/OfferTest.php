<?php

namespace Tests\Unit;

use App\Offer;
use Illuminate\Support\Str;
use Tests\TestCase;

class OfferTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $offer=new Offer();
        $offer->price=1500000000;
        $this->assertEquals($offer->get_price_vnd(),"1 tỉ 500 triệu");
    }
}
