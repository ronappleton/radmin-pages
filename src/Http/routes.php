<?php

Route::group(['prefix' => 'page', 'middleware' => ['web', 'auth']], function () {
    Route::any('{page}', 'RonAppleton\Radmin\Pages\Http\Controllers\PageController@handle');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => 'page/ajax-resources'], function () {
        Route::get('{resource}', 'RonAppleton\Radmin\Pages\Http\Controllers\PageResourceController@handle');
        Route::get('versions/{resource}', 'RonAppleton\Radmin\Pages\Http\Controllers\PageResourceController@versions');
    });
    Route::resource('page', 'RonAppleton\Radmin\Pages\Http\Controllers\PageController');
    Route::get('page/versions/{page}', 'RonAppleton\Radmin\Pages\Http\Controllers\PageController@versions');
    Route::resource('page-category', 'RonAppleton\Radmin\Pages\Http\Controllers\PageCategoryController');

});