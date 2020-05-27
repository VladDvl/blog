<?php

Auth::routes();

Route::post('home','HomeController@postIndex');
Route::post('home/avatar','HomeController@avatarChange');
Route::post('home/table','HomeController@homeTable');
Route::post('chat/send', 'ChatController@postIndex')->middleware('auth');
Route::post('group/create', 'GroupController@createGroup');
Route::post('group/send', 'GroupController@postIndex');
Route::post('group/add', 'GroupController@addPartitipant');
Route::post('group/enter', 'GroupController@enterPartitipant');
Route::post('group/group-avatar', 'GroupController@avatarChange');
Route::post('tag/create', 'TagCreateController@createTag');
Route::post('tag/delete', 'TagDeleteController@deleteTag');
Route::post('tag/subscribe', 'SubscriptionController@tagSubscribe');
Route::post('user/subscribe', 'SubscriptionController@userSubscribe');
Route::post('tag/unsubscribe', 'UnSubscriptionController@tagUnSubscribe');
Route::post('user/unsubscribe', 'UnSubscriptionController@userUnSubscribe');
Route::post('notifications-delete', 'NotificationController@deleteAllNotifications');
Route::post('notification-delete', 'NotificationController@deleteNotification');
Route::post('notification-read', 'NotificationController@readNotification');

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
    Route::get('hide-comment', 'HideController@hideComment');
    Route::get('chat/{slug}', 'ChatController@getIndex')->middleware('auth');
    Route::get('group/{slug}', 'GroupController@getIndex')->middleware('auth');
    Route::get('group-not-found', 'GroupController@getIndex')->middleware('auth');
    Route::get('all-groups', 'GroupController@getPublic')->middleware('auth');
    Route::get('all-tags', 'TagsShowController@getIndex');
    Route::get('tag/{slug}', 'TagController@getIndex');
    Route::get('feed', 'FeedController@getIndex')->middleware('auth');
    Route::get('{url}', 'MaintextController@getIndex'); //этот запрос должен быть в конце
});