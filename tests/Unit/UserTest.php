<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function test_can_create_user()
    {
        $user = factory(User::class)->create();
        $this->assertNotNull($user->id);
        $this->assertNotNull($user->name);
        $this->assertNotNull($user->email);
        $user->forceDelete();
    }

    public function test_user_role()
    {
        $user = new User();
        $this->assertTrue($user->has_role("user"));
        $this->assertFalse($user->has_role("admin"));
        $user->add_role('admin');
        $this->assertTrue($user->has_role("admin"));
    }
}
