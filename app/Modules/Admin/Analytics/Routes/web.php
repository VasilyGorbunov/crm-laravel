<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'analytics', 'middleware' => []], function () {
    Route::get('/export/{user}/{dateStart}/{dateEnd}', 'AnalyticsController@export')->name('analytics.export');
});
