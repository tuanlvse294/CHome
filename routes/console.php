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

Artisan::command('reset_admin', function () {
    $admin = \App\User::query()->where('email', '=', 'admin@gmail.com')->firstOrFail();
    $admin->password = bcrypt('123456');
    $admin->save();
    $this->comment('Reset admin');
})->describe('Reset admin password');
