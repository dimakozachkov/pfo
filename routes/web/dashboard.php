<?php

Route::get('/', function () {
    return redirect()->route('dashboard.orphans.index');
})->name('index');

Route::resource('orphans', 'OrphanController')
    ->except(['show']);
Route::resource('users', 'UserController')
    ->except(['show']);
Route::resource('countries', 'CountryController')
    ->except(['show']);

Route::resource('residences', 'ResidenceController')
    ->except(['show']);

Route::group([
    'prefix' => 'layouts',
    'as' => 'layouts.'
], function () {
    Route::get('/', 'LayoutController@index')
        ->name('index');

    Route::get('/create', 'LayoutController@create')
        ->name('create');
});