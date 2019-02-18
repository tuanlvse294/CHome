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

Route::middleware(['auth'])->group(function () {

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });

    Route::get('/profile/info', 'ProfileController@edit_info');
    Route::post('/profile/info', 'ProfileController@save_info');
    Route::get('/profile/password', 'ProfileController@edit_password');
    Route::post('/profile/password', 'ProfileController@save_password');
    Route::get('/offers/{offer}/like', 'OfferController@like');
    Route::get('/offers/{offer}/unlike', 'OfferController@unlike');

});

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

Route::resource('/offers', 'OfferController');

