<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserRole()
    {
        $user = new User();
        $this->assertTrue($user->has_role("user"));
        $this->assertFalse($user->has_role("admin"));
        $user->add_role('admin');
        $this->assertTrue($user->has_role("admin"));
    }
}
