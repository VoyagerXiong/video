<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::match(['get','post'],'/login','Admin\EntryController@login');
include __DIR__ . '/admin/web.php';
Route::match(['get','post'],'/uploader','Component\UploadController@uploader');
Route::match(['get','post'],'/filelists','Component\UploadController@fileLists');
Route::match(['get','post'],'/sign','Component\OssController@sign');
include __DIR__ . '/api.php';