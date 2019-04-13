<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertSeeText('Tin đặc biệt');
        $response->assertSeeText('Tìm kiếm nâng cao');
        $response->assertStatus(200);
    }

    public function test404()
    {
        $response = $this->get('/adawdawdaw');
        $response->assertSeeText('Không tìm thấy kết quả phù hợp!!');
    }
}
