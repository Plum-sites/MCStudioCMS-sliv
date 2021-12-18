<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', 'ApiController@script')->name('api');
Route::post('/', 'ApiController@script')->name('api');

Route::post('/gravit/auth', 'ApiController@gravitAuth')->name('gravitAuth');