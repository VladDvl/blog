<?php

Route::get('/','BaseController@getIndex');
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::post('home','HomeController@postIndex');
Route::post('home/avatar','HomeController@avatarChange');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('post/{slug}', 'PostController@getIndex');
Route::post('post/{slug}', 'PostController@postIndex');

Route::get('cat/{slug}', 'CategoryController@getIndex');

Route::post('/ajax/modal', 'Ajax\ModalController@postIndex');

Route::get('{url}', 'MaintextController@getIndex'); //этот запрос должен быть в конце
