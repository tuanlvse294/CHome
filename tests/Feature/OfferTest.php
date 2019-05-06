<?php

namespace Tests\Feature;

use App\Offer;
use App\User;
use Tests\TestCase;

class OfferTest extends TestCase
{
    public function test_guest_new_offer()
    {
        $response = $this->get(route('offers.create'));
        $response->assertRedirect('login'); //guest cannot make a new offer
    }

    public function test_logged_in()
    {
        $user = User::query()->first();
        $this->actingAs($user)->get(route('offers.create'))->assertSeeText('Đăng tin rao vặt mới');
    }


    public function test_guest_view_offer()
    {
        $offer = Offer::query()->find(275);
        echo $offer->id;
        echo $offer->title;
        $response = $this->get('offers/' . $offer->id);
        $response->assertSeeText($offer->title);
        $response->assertSeeText($offer->content);
        $response->assertSeeText($offer->user->name);
        $response->assertSeeText($offer->user->phone);
    }

    public function test_user_view_offer()
    {
        $user = User::query()->first();
        $offer = Offer::query()->find(275);
        echo $offer->id;
        echo $offer->title;
        $response = $this->actingAs($user)->get('offers/' . $offer->id);
        $response->assertSeeText($offer->title);
        $response->assertSeeText($offer->content);
        $response->assertSeeText($offer->user->name);
        $response->assertSeeText($offer->user->phone);
        $response->assertSeeText($user->name);
    }


}
