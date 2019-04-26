<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    //try to l
    public function test_see_login()
    {
        $response = $this->get('/');
        $response->assertSeeText('Đăng nhập');
        $response->assertStatus(200);
    }

    public function test_logged_in()
    {
        $user = User::query()->first();
        echo ($user);
        self::assertNotNull($user->id);
    }


}
