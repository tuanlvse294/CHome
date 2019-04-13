<?php

namespace Tests\Unit;

use App\LogData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        LogData::log(LogData::REVENUE, ['user_id' => 4]);
        LogData::log(LogData::REVENUE, ['usr_id' => 4]);
        echo LogData::query()->where('value->user_id','=',4)->toSql();
        $this->assertEquals(1,LogData::query()->where('value->user_id','=',4)->count());
        $this->assertTrue(true);
    }
}
