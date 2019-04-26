<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    //normally go to home
    public function test_it_can_see_home()
    {
        $response = $this->get('/');
        $response->assertSeeText('Tin đặc biệt');
        $response->assertSeeText('Tìm kiếm nâng cao');
        $response->assertStatus(200);
    }

    //try a random url
    public function test_go_to_no_where()
    {
        $response = $this->get('/adawdawdaw');
        $response->assertSeeText('Không tìm thấy kết quả phù hợp!!');
    }
}
