<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'analytics', 'middleware' => []], function () {
    Route::post('/', 'Api\AnalyticsController@index')->name('api.analytics.store');
});
