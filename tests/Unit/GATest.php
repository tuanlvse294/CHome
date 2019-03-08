<?php

namespace Tests\Unit;

use Analytics;
use Spatie\Analytics\Period;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GATest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        echo  Analytics::fetchMostVisitedPages(Period::days(7));
        $this->assertNull(null);
    }
}
