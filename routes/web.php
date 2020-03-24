<?php

Auth::routes();

Route::post('home','HomeController@postIndex');
Route::post('home/avatar','HomeController@avatarChange');
Route::post('home/table','HomeController@homeTable');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::post('post/{slug}', 'PostController@postIndex');

Route::post('/ajax/modal', 'Ajax\ModalController@postIndex');

route::group(['middleware' => ['lang']], function(){
    Route::get('/','BaseController@getIndex');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('home/{slug}', 'HomeController@editPost')->name('edit_post');
    Route::get('post/{slug}', 'PostController@getIndex');
    Route::get('cat/{slug}', 'CategoryController@getIndex');
    Route::get('user/{slug}', 'ProfileController@getIndex');
    Route::get('search', 'SearchController@getIndex')->name('search');
    Route::get('{url}', 'MaintextController@getIndex'); //этот запрос должен быть в конце
});