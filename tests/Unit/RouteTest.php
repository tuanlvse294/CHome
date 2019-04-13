<?php

namespace Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $this->assertTrue(true);
//        $this->assertTrue(Str::endsWith(route('admin.test'), '/admin/test'));
    }
}
