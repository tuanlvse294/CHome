<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::query()->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'avatar_url' => 'no_avatar.png',
            'phone'=>'0123456789',
            'address'=>'nope',
            'password' => bcrypt('secret'),
        ]);
    }
}
