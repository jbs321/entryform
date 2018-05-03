<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/tickets', 'HomeController@showTicket');

    Route::name('carving')->post('/carving', 'CarvingController@create');
    Route::post('/carving/delete', 'CarvingController@delete');
});


Route::middleware(['auth', \App\Http\Middleware\checkAdmin::class])->group(function () {
    Route::name('admin')->get('/admin', 'AdminController@viewDashboard');
});