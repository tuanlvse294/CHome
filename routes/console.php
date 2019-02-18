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
        \App\City::query()->create(
            [
                'id' => $city_code,
                'name' => $city->name,
                'slug' => $city->slug,
            ]
        );
        foreach ($city->districts as $district_code => $district)
            \App\District::query()->create(
                [
                    'id' => $district_code,
                    'name' => $district->name,
                    'slug' => $district->slug,
                    'city_id' => $city_code,
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
