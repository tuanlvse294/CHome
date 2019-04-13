<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NofTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserRole()
    {
        $user = User::query()->first();
        $this->assertNotNull($user->all_notifications);
    }
}
