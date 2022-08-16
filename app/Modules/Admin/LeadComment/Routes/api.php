<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'lead-comments', 'middleware' => []], function () {
  Route::post('/', 'Api\LeadCommentController@store')->name('api.lead-comments.store');
});
