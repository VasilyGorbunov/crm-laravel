<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'menus', 'middleware' => []], function () {
    Route::get('/', 'Api\MenuController@index')->name('api.menus.index');
});
