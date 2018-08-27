<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 26.08.2018
 * Time: 14:33
 */

Route::group(['middleware' => 'can:update,orphan'], function () {
    Route::resource('orphans', 'OrphanController', [
        'only' => ['update']
    ]);
});

Route::group(['middleware' => 'can:delete,orphan'], function () {
    Route::resource('orphans', 'OrphanController', [
        'only' => ['destroy']
    ]);
});

Route::resource('orphans', 'OrphanController', [
    'only' => ['create', 'store', 'show']
]);