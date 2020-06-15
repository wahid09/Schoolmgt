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
Route::resource('/headersetup', 'HeaderSetupController');
Route::resource('/footersetup', 'FooterSetupController');
Route::resource('/slidersetup', 'SliderController');
Route::get('/status/{id}', 'SliderController@ChangeStatus')->name('status');

//Admin settings
Route::resource('/schoolmgt', 'SchoolManagementController');
Route::get('/status_update/{id}', 'SchoolManagementController@StatusUpdate')->name('status_update');

Route::resource('/classmgt', 'ClassMgtController');
Route::get('/status_update/{id}', 'ClassMgtController@StatusUpdate')->name('status_update');

Route::resource('/batchmgt', 'BatchMgtController');
Route::get('/batcbyajax', 'BatchMgtController@BatchByAjax')->name('batcbyajax');
//Route::get('/status_update/{id}', 'BatchMgtController@StatusUpdate')->name('status_update');
Route::get('/unpublishbyajax', 'BatchMgtController@BatchUnpublishByAjax')->name('unpublishbyajax');
Route::get('/publishbyajax', 'BatchMgtController@BatchpublishByAjax')->name('publishbyajax');
Route::get('/batchdeletebyajax', 'BatchMgtController@BatchDeleteByAjax')->name('batchdeletebyajax');

Route::resource('/coachingtype', 'CoachingMgtController');
Route::get('/coaching_type_list', 'CoachingMgtController@CoachingTypeList')->name('coaching_type_list');
Route::get('/coachingdeletebyajax', 'CoachingMgtController@CoachingDeleteByAjax')->name('coachingdeletebyajax');
Route::get('/caochingtypeunpublishbyajax', 'CoachingMgtController@CoachingUnpublishByAjax')->name('caochingtypeunpublishbyajax');
Route::get('/caochingtypepublishbyajax', 'CoachingMgtController@CoachingpublishByAjax')->name('caochingtypepublishbyajax');