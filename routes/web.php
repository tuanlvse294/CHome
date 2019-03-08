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


//auth zone
Route::middleware(['auth'])->group(function () {

    Route::get('logout', function () {
        Auth::logout();
        return redirect(route('home'));
    })->name('logout.get');

    Route::prefix('profile')->group(function () {
        Route::get('info', 'UserController@edit_info')->name('info.edit');
        Route::post('info', 'UserController@save_info')->name('info.save');
        Route::get('password', 'UserController@edit_password')->name('password.edit');
        Route::post('password', 'UserController@save_password')->name('password.save');

    });

    Route::prefix('offers')->as('offers.')->group(function () {
        Route::get('manage', 'OfferController@manage')->name('manage');
        Route::get('trash', 'OfferController@trash')->name('trash');
        Route::get('{offer}/like', 'OfferController@like')->name('like');
        Route::get('{offer}/unlike', 'OfferController@unlike')->name('unlike');
        Route::get('{offer}/delete', 'OfferController@destroy')->name('delete');
        Route::get('{offer}/force_delete', 'OfferController@force_delete')->name('force_delete');
        Route::get('{offer}/restore', 'OfferController@restore')->name('restore');
    });

    Route::resource('offers', 'OfferController')->except([
        'show'
    ]);;

});

//admin zone

Route::middleware(['auth', 'admin'])->prefix("admin")->group(function () {
    Route::get('test', function () {
        return "ok";
    })->name('admin.test');
    Route::prefix('users')->group(function () {
        Route::get('manage', 'UserController@manage')->name('users.manage');
        Route::get('trash', 'UserController@trash')->name('users.trash');
        Route::get('{user}/delete', 'UserController@delete')->name('users.delete');
        Route::get('{user}/force_delete', 'UserController@force_delete')->name('users.force_delete');
        Route::get('{user}/restore', 'UserController@restore')->name('users.restore');
    });
    Route::get('setting', 'SettingController@index')->name('setting');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});


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
})->name('cities');


Auth::routes();

Route::get('/users/{user}/show', 'UserController@show')->name('users.show');


Route::resource('offers', 'OfferController')->only([
    'show'
]);;