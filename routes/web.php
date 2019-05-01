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
use Illuminate\Support\Facades\Input;

Route::middleware(['auth'])->group(function () {

    Route::get('logout', function () {
        Auth::logout();
        return redirect(route('home'));
    })->name('logout.get');

    Route::prefix('profile')->group(function () {
        Route::get('transactions', 'UserController@my_transactions')->name('users.transactions');
        Route::get('notifications', 'UserController@notifications')->name('users.notifications');
        Route::get('show_notification/{notification}', 'UserController@show_notification')->name('users.show_notification');
        Route::get('liked', 'UserController@liked')->name('users.liked');
        Route::get('mine', 'UserController@show_mine')->name('users.mine');
        Route::get('pending', 'UserController@show_pending')->name('users.pending');
        Route::get('premium', 'UserController@show_premium')->name('users.premiums');
        Route::get('info', 'UserController@edit_info')->name('info.edit');
        Route::post('info', 'UserController@save_info')->name('info.save');
        Route::get('password', 'UserController@edit_password')->name('password.edit');
        Route::get('password/admin', 'UserController@edit_password_admin')->name('password.edit.admin');
        Route::post('password', 'UserController@save_password')->name('password.save');

    });

    Route::prefix('offers')->as('offers.')->group(function () {
        Route::get('{offer}/delete', 'OfferController@destroy')->name('delete');
        Route::get('{offer}/promote', 'OfferController@promote')->name('promote');
        Route::get('{offer}/promote/{pack}/pick', 'OfferController@pick_promote')->name('promote.pick');
        Route::get('{offer}/like', 'OfferController@like')->name('like');
        Route::get('{offer}/unlike', 'OfferController@unlike')->name('unlike');
    });

    Route::resource('offers', 'OfferController')->except([
        'show'
    ]);;
    Route::get('show_hidden/{offer_id}', 'OfferController@show_hidden')->name('offers.show_hidden');

});

//admin zone

Route::prefix('users')->as('users.')->group(function () {
    Route::get('export', 'UserController@export_csv')->name('export');
});
Route::middleware(['auth', 'admin'])->prefix("admin")->group(function () {
    Route::get('/', function () {
        return redirect(route('offers.manage'));
    });
    Route::prefix('offers')->as('offers.')->group(function () {
        Route::get('manage', 'OfferController@manage')->name('manage');
        Route::get('manage_accept', 'OfferController@manage_accept')->name('manage_accept');
        Route::get('{offer}/accept', 'OfferController@accept')->name('accept');
        Route::get('trash', 'OfferController@trash')->name('trash');
        Route::get('{offer}/force_delete', 'OfferController@force_delete')->name('force_delete');
        Route::get('{offer}/restore', 'OfferController@restore')->name('restore');
    });
    Route::prefix('premium')->group(function () {
        Route::resource('premium', 'PremiumPackController');
        Route::get('manage', 'PremiumPackController@manage')->name('premium.manage');
        Route::get('delete/{premium}', 'PremiumPackController@delete')->name('premium.delete');
    });
    Route::get('transaction/manage', 'TransactionController@manage')->name('transaction.manage');
    Route::prefix('users')->as('users.')->group(function () {
        Route::get('manage', 'UserController@manage')->name('manage');
        Route::get('trash', 'UserController@trash')->name('trash');
        Route::get('{user}/delete', 'UserController@delete')->name('delete');
        Route::get('{user}/edit_permission', 'UserController@edit_permission')->name('edit_permission');
        Route::post('{user}/edit_permission', 'UserController@save_permission')->name('save_permission');
        Route::get('{user}/force_delete', 'UserController@force_delete')->name('force_delete');
        Route::get('{user}/restore', 'UserController@restore')->name('restore');
    });
    Route::get('setting', 'SettingController@index')->name('setting');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('revenue', 'DashboardController@revenue')->name('revenue');
});


//free access zone
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/', 'HomeController@index')->name('home');
Route::get('/premiums', 'HomeController@get_premiums')->name('get_premiums');


Route::get('/cities/{city}/districts', function ($city_id) {
    $city = \App\City::query()->findOrNew($city_id);
    return view('layouts.search.district_select', ['districts' => $city->districts]);
});

Route::get('/cities', function () {
    return \App\City::query()->select('id', 'name')->get();
})->name('cities');


Auth::routes();

Route::get('/users/{user}/show', 'UserController@show')->name('users.show');
Route::get('/receive_payment', function () {
    return route('offers.promote.pick', ['offer' => Input::get('transaction_info'), 'pack' => Input::get('order_code')]);
})->name('receive_payment');


Route::resource('offers', 'OfferController')->only([
    'show'
]);;