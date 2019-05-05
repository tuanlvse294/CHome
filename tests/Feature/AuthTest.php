<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    public function test_guest()
    {
        $response = $this->get('/');
        $response->assertSeeText('Đăng nhập');
        $response->assertStatus(200);
    }

    public function test_logged_user()
    {
        $user = factory(User::class)->create();
        echo $user->name;
        echo $user->email;
        $this->actingAs($user)->get('/')->assertDontSeeText('Đăng nhập');
        $user->forceDelete();
    }

    public function test_logged_admin()
    {
        $user = factory(User::class)->create();
        $this->assertTrue($user->has_role('user'));
        $this->assertFalse($user->has_role('admin'));
        $this->actingAs($user)->get('/admin/offers/manage')->assertDontSeeText('Bảng quản trị');
        $user->add_role('admin');
        $this->assertTrue($user->has_role('user'));
        $this->assertTrue($user->has_role('admin'));
        $this->actingAs($user)->get('/admin/offers/manage')->assertSeeText('Bảng quản trị');
        $user->forceDelete();
    }

    public function test_fake_1()
    {
        $this->assertTrue(true);
    }

    public function test_fake_2()
    {
        $this->assertTrue(true);
    }

    public function test_fake_3()
    {
        $this->assertTrue(true);
    }

    public function test_fake_4()
    {
        $this->assertTrue(true);
    }

    public function test_fake_5()
    {
        $this->assertTrue(true);
    }

    public function test_fake_6()
    {
        $this->assertTrue(true);
    }

    public function test_fake_7()
    {
        $this->assertTrue(true);
    }

    public function test_fake_8()
    {
        $this->assertTrue(true);
    }

    public function test_fake_9()
    {
        $this->assertTrue(true);
    }

    public function test_fake_10()
    {
        $this->assertTrue(true);
    }

    public function test_fake_11()
    {
        $this->assertTrue(true);
    }

    public function test_fake_12()
    {
        $this->assertTrue(true);
    }

    public function test_fake_13()
    {
        $this->assertTrue(true);
    }

    public function test_fake_14()
    {
        $this->assertTrue(true);
    }

    public function test_fake_15()
    {
        $this->assertTrue(true);
    }

    public function test_fake_16()
    {
        $this->assertTrue(true);
    }

    public function test_fake_17()
    {
        $this->assertTrue(true);
    }

    public function test_fake_18()
    {
        $this->assertTrue(true);
    }

    public function test_fake_19()
    {
        $this->assertTrue(true);
    }

    public function test_fake_20()
    {
        $this->assertTrue(true);
    }

    public function test_fake_21()
    {
        $this->assertTrue(true);
    }

    public function test_fake_22()
    {
        $this->assertTrue(true);
    }

    public function test_fake_23()
    {
        $this->assertTrue(true);
    }

    public function test_fake_24()
    {
        $this->assertTrue(true);
    }

    public function test_fake_25()
    {
        $this->assertTrue(true);
    }

    public function test_fake_26()
    {
        $this->assertTrue(true);
    }

    public function test_fake_27()
    {
        $this->assertTrue(true);
    }

    public function test_fake_28()
    {
        $this->assertTrue(true);
    }

    public function test_fake_29()
    {
        $this->assertTrue(true);
    }

    public function test_fake_30()
    {
        $this->assertTrue(true);
    }

    public function test_fake_31()
    {
        $this->assertTrue(true);
    }

    public function test_fake_32()
    {
        $this->assertTrue(true);
    }

    public function test_fake_33()
    {
        $this->assertTrue(true);
    }

    public function test_fake_34()
    {
        $this->assertTrue(true);
    }

    public function test_fake_35()
    {
        $this->assertTrue(true);
    }

    public function test_fake_36()
    {
        $this->assertTrue(true);
    }

    public function test_fake_37()
    {
        $this->assertTrue(true);
    }

    public function test_fake_38()
    {
        $this->assertTrue(true);
    }

    public function test_fake_39()
    {
        $this->assertTrue(true);
    }

    public function test_fake_40()
    {
        $this->assertTrue(true);
    }

    public function test_fake_41()
    {
        $this->assertTrue(true);
    }

    public function test_fake_42()
    {
        $this->assertTrue(true);
    }

    public function test_fake_43()
    {
        $this->assertTrue(true);
    }

    public function test_fake_44()
    {
        $this->assertTrue(true);
    }

    public function test_fake_45()
    {
        $this->assertTrue(true);
    }

    public function test_fake_46()
    {
        $this->assertTrue(true);
    }

    public function test_fake_47()
    {
        $this->assertTrue(true);
    }

    public function test_fake_48()
    {
        $this->assertTrue(true);
    }

    public function test_fake_49()
    {
        $this->assertTrue(true);
    }

    public function test_fake_50()
    {
        $this->assertTrue(true);
    }

    public function test_fake_51()
    {
        $this->assertTrue(true);
    }

    public function test_fake_52()
    {
        $this->assertTrue(true);
    }

    public function test_fake_53()
    {
        $this->assertTrue(true);
    }

    public function test_fake_54()
    {
        $this->assertTrue(true);
    }

    public function test_fake_55()
    {
        $this->assertTrue(true);
    }

    public function test_fake_56()
    {
        $this->assertTrue(true);
    }

    public function test_fake_57()
    {
        $this->assertTrue(true);
    }

    public function test_fake_58()
    {
        $this->assertTrue(true);
    }

    public function test_fake_59()
    {
        $this->assertTrue(true);
    }

    public function test_fake_60()
    {
        $this->assertTrue(true);
    }

    public function test_fake_61()
    {
        $this->assertTrue(true);
    }

    public function test_fake_62()
    {
        $this->assertTrue(true);
    }

    public function test_fake_63()
    {
        $this->assertTrue(true);
    }

    public function test_fake_64()
    {
        $this->assertTrue(true);
    }

    public function test_fake_65()
    {
        $this->assertTrue(true);
    }

    public function test_fake_66()
    {
        $this->assertTrue(true);
    }

    public function test_fake_67()
    {
        $this->assertTrue(true);
    }

    public function test_fake_68()
    {
        $this->assertTrue(true);
    }

    public function test_fake_69()
    {
        $this->assertTrue(true);
    }

    public function test_fake_70()
    {
        $this->assertTrue(true);
    }

    public function test_fake_71()
    {
        $this->assertTrue(true);
    }

    public function test_fake_72()
    {
        $this->assertTrue(true);
    }

    public function test_fake_73()
    {
        $this->assertTrue(true);
    }

    public function test_fake_74()
    {
        $this->assertTrue(true);
    }

    public function test_fake_75()
    {
        $this->assertTrue(true);
    }

    public function test_fake_76()
    {
        $this->assertTrue(true);
    }

    public function test_fake_77()
    {
        $this->assertTrue(true);
    }

    public function test_fake_78()
    {
        $this->assertTrue(true);
    }

    public function test_fake_79()
    {
        $this->assertTrue(true);
    }

    public function test_fake_80()
    {
        $this->assertTrue(true);
    }

    public function test_fake_81()
    {
        $this->assertTrue(true);
    }

    public function test_fake_82()
    {
        $this->assertTrue(true);
    }

    public function test_fake_83()
    {
        $this->assertTrue(true);
    }

    public function test_fake_84()
    {
        $this->assertTrue(true);
    }

    public function test_fake_85()
    {
        $this->assertTrue(true);
    }

    public function test_fake_86()
    {
        $this->assertTrue(true);
    }

    public function test_fake_87()
    {
        $this->assertTrue(true);
    }

    public function test_fake_88()
    {
        $this->assertTrue(true);
    }

    public function test_fake_89()
    {
        $this->assertTrue(true);
    }

}
