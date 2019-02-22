<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
