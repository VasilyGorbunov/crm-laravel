<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auths', 'middleware' => []], function () {
    Route::post('/login', 'Api\LoginController@login')->name('api.auths.login');
});
