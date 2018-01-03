<?php

Route::group(['prefix' => 'page', 'middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => 'ajax-resources'], function () {
        Route::get('{resource}', 'RonAppleton\Radmin\Pages\Http\Controllers\PageResourceController@handle');
    });
    Route::any('{page}', 'RonAppleton\Radmin\Pages\Http\Controllers\PageController@handle');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
   Route::resource('page', 'RonAppleton\Radmin\Pages\Http\Controllers\PageController');
   Route::resource('page-category', 'RonAppleton\Radmin\Pages\Http\Controllers\PageCategoryController');

});