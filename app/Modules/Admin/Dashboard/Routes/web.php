<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => []], function () {
    Route::get('/', 'DashboardController@index')->name('dashboards.index');
});
