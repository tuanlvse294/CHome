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


//free access zone
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/', 'HomeController@index')->name('home');


Route::get('/cities/{city}/districts', function ($city_id) {
    $city = \App\City::query()->findOrNew($city_id);
    return view('layouts.search.district_select', ['districts' => $city->districts]);
});

Route::get('/cities', function () {
    return \App\City::query()->select('id', 'name')->get();
});

Route::resource('/offers', 'OfferController');

Auth::routes();

//auth zone
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

//admin zone

Route::middleware(['auth', 'admin'])->prefix("admin")->group(function () {
    Route::get('test', function () {
        return "ok";
    });
});

