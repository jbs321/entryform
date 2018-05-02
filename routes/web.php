<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/tickets', 'HomeController@showTicket');

    Route::name('carving')->post('/carving', 'CarvingController@create');
    Route::get('/carving/{carving}', 'CarvingController@delete');
});


Route::middleware(['auth', \App\Http\Middleware\checkAdmin::class])->group(function () {
    Route::get('/admin', 'AdminController@viewDashboard');
});