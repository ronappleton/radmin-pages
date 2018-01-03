<?php

Route::group(['prefix' => 'page', 'middleware' => ['web', 'auth']], function () {
    Route::any('{page}', 'RonAppleton\Radmin\Pages\Http\Controllers\PageController@handle');
});
