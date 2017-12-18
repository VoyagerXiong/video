<?php

Route::group(
    ['prefix'=>'admin','namespace'=>'Admin'],
    function(){
        //prefix是admin，所以匹配包含 "/admin/login" 的 URL
        //namespace为Admin，会自动寻找App\Http\Controllers\Admin下面的EntryController
        Route::match(['get','post'],'/login','EntryController@login');
        Route::match(['get'],'/logout','EntryController@logout');
        Route::match(['get'],'/password','MyController@password');
        Route::match(['post'],'/changePassword','MyController@changePassword');
        Route::match(['get'],'/index','EntryController@index');
        Route::resource('tag','TagController');
        Route::resource('lesson','LessonController');
});