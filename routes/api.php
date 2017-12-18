<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    ['prefix' => 'api', 'namespace' => 'Api'],
    function () {
        Route::match(['get'], '/tags', 'ContentController@tags');
        Route::match(['get'], '/lessons/{tid?}', 'ContentController@lessons');
        Route::match(['get'], '/CommendLessons/{tid}', 'ContentController@CommendLessons');
        Route::match(['get'], '/HotLessons/{tid}', 'ContentController@HotLessons');
        Route::match(['get'], '/videos/{lid}', 'ContentController@videos');
        Route::match(['get'], '/preLesson/{lid}', 'ContentController@preLesson');
    });
header('Access-Control-Allow-Origin:*');