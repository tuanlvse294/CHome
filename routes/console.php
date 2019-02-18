<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('fill-data', function () {
    \App\District::query()->delete();
    \App\City::query()->delete();
    $tree = json_decode(file_get_contents('database/seeds/tree.json'));
    foreach ($tree as $city_code => $city) {
        $city_m = \App\City::query()->create(
            [
                'name' => $city->name,
                'slug' => $city->slug,
            ]
        );
        foreach ($city->districts as $district_code => $district)
            \App\District::query()->create(
                [
                    'name' => $district->name,
                    'slug' => $district->slug,
                    'city_id' => $city_m->id,
                ]
            );
    }
})->describe('Fill locations data');

Artisan::command('make_admin', function () {
    \App\User::query()->insert([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'avatar_url' => 'no_avatar.png',
        'phone' => '0123456789',
        'address' => 'nope',
        'password' => bcrypt('123456'),
    ]);
})->describe('Create admin account');

Artisan::command('reset_admin', function () {
    $admin = \App\User::query()->where('email', '=', 'admin@gmail.com')->firstOrFail();
    $admin->password = bcrypt('123456');
    $admin->save();
    $this->comment('Reset admin');
})->describe('Reset admin password');

Artisan::command('fill_crawl', function () {
    \App\Offer::query()->delete();
    $scanned_directory = array_diff(scandir('crawl_data'), array('..', '.'));
    foreach ($scanned_directory as $bds_dir) {
        $metadata = json_decode(file_get_contents('crawl_data/' . $bds_dir . '/metadata.json'));
//        dd($metadata);
        $this->comment($metadata->uid);
        $offer = new \App\Offer();
        $offer->fill(array('id' => $metadata->uid, 'title' => $metadata->title, 'area' => 0, 'city_id' => 107, 'district_id' => 1096, 'address' => 'aasa', 'content' => $metadata->content, 'price' => 0));
        $imgs_scanned_directory = array_diff(scandir('crawl_data/' . $metadata->uid . '/images'), array('..', '.'));
        if (sizeof($imgs_scanned_directory) > 0) {
            $imgs = [];
            foreach ($imgs_scanned_directory as $img) {
                $imgs[] = $img;
                copy('crawl_data/' . $metadata->uid . '/images/' . $img, 'public/uploads/' . $img);
            }
            $offer->images = json_encode($imgs);
        }
        $offer->save();
    }
})->describe("Fill database by crawl data");
