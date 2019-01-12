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

Route::get('login', function () {
    if (\Auth::check()) {
        \Auth::logout();
    }

    return view('login');

})->name('login');

Route::post('login', 'Auth\LoginController@login')
    ->name('user.login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('/upload', 'PhotoController@upload')->name('upload');

    Route::get('/', 'MainController@index')->name('home');
    Route::delete('/photo/{photo}', 'PhotoController@destroy')->name('photo.destroy');

    Route::get('/countries/{country}', 'MainController@country')->name('country');

    Route::resource('residences', 'ResidenceController', [
        'only' => ['index', 'store', 'update'],
    ]);

    Route::get('find', 'MainController@find')->name('find');
	
	Route::get('download/{template}','MainController@download')->name('download.photos');
	Route::get('download/{orphan}/{template}', 'MainController@downloadOne')->name('download');
	Route::get('download-photos/{template}', 'MainController@downloadMany')->name('download.many');

});