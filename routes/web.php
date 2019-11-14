<?php

Route::get('/','BaseController@getIndex');
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::post('home','HomeController@postIndex');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('post/{slug}', 'PostController@getIndex');
Route::get('cat/{slug}', 'CategoryController@getIndex');

Route::get('{url}', 'MaintextController@getIndex'); //этот запрос должен быть в конце
