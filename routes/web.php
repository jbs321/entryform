<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::name('carving')->post('/carving', 'CarvingController@create')->middleware('auth');;
Route::get('/carving/{carving}', 'CarvingController@delete')->middleware('auth');