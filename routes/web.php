<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cities/{city}/districts', function ($city_id) {
    $city = \App\City::query()->findOrNew($city_id);
    $district = new \App\District();
    $district->id = -1;
    $district->name = 'Tất cả quận, huyện';
    $city->districts = $city->districts->prepend($district);
    return view('layouts.search.distrct_select', ['districts' => $city->districts]);
});
Route::get('/cities', function () {
    return \App\City::query()->select('id', 'name')->get();
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::resource('/offers', 'OfferController');
Route::get('/update_git', function () {
    dd(shell_exec('pwd;cd ..;pwd;git pull'));
});