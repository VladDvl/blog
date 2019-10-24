<?php

Route::get('/','BaseController@getIndex');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});



Route::get('{url}', 'MaintextController@getIndex'); //этот запрос должен быть в конце
