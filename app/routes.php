<?php

/*
|--------------------------------------------------------------------------
| Routes for Login
|--------------------------------------------------------------------------
|
*/
Route::get('/login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

Route::get('/','StudentsController@index');
Route::post('/student/{rut}','StudentsController@search');
Route::post('/student/get/{rut}','StudentsController@show');


Route::group(array('before' => 'auth'), function() {
    Route::get('/admin', ['as' => 'home', 'uses' => 'TeacherController@index']);
    Route::get('/admin/courses','TeacherController@courses');
    Route::get('/admin/import','ImportController@index');
    Route::post('/admin/import/store/students','ImportController@students');
});
