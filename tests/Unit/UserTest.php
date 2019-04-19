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
    public function testCreateUser()
    {
        $user = new User();
        $user->name = 'xxx';
        $user->email = 'aaa@fmail.com';
        $user->password = 'xxx';
        $this->assertNull($user->id);
        $user->save();
        $this->assertNotNull($user->id);
        $user->delete();
    }

    public function testUserRole()
    {
        $user = new User();
        $this->assertTrue($user->has_role("user"));
        $this->assertFalse($user->has_role("admin"));
        $user->add_role('admin');
        $this->assertTrue($user->has_role("admin"));
    }
}
