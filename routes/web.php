<?php


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user_list', 'Auth\RegisterController@userList')->name('user_list');
Route::get('/user_profile/{userId}', 'Auth\RegisterController@userProfile')->name('user_profile');
Route::get('/update_profile/{userId}', 'Auth\RegisterController@updateProfile')->name('update_profile');
Route::post('/user_info_update', 'Auth\RegisterController@updateProfileInfo')->name('user_info_update');
Route::get('/update_profile_pic/{userId}', 'Auth\RegisterController@updateProfilePic')->name('update_profile_pic');
Route::post('/update_porofile_pic', 'Auth\RegisterController@updateProfileImage')->name('update_porofile_pic');
Route::post('/password_update', 'Auth\RegisterController@passwordUpdate')->name('password_update');
//Header Settings
//
Route::resource('/headersetup', 'HeaderSetupController');
Route::resource('/footersetup', 'FooterSetupController');
