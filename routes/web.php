<?php

use \App\Http\Middleware\AuthorizeCarvingChangeMiddleware;
use \App\Http\Middleware\checkAdmin;
use \App\Http\Middleware\AuthorizeUserChangeMiddleware;
use \App\Http\Middleware\checkRoleJudgeMiddleware;
use \Illuminate\Support\Facades\Auth;

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('/storage/{filename}', 'PhotoController@show');
Route::get('/storage/{filename}/{size}', 'PhotoController@showWithSize');
Route::get('/gallery/download/photo/{carving}/{phototag}', 'GalleryController@downloadImage');

Route::middleware(['auth'])->group(function () {
//    Route::get('/', 'HomeController@index')->name('home');

    //User protected Routes
    Route::middleware([AuthorizeUserChangeMiddleware::class])->group(function () {
        Route::get('/carving/excel/{user}', 'CarvingController@downloadCarvingsForUser');
        Route::post('/user/{user}/record-payment', 'UserController@recordPayment');
        Route::get('/user/{user}/view-payments', 'UserController@viewPayments');
        Route::get('/user/{user}/edit', 'UserController@edit');
        Route::post('/user/{user}/update', 'UserController@update');
    });

    //Carving protected Routes
    Route::middleware([AuthorizeCarvingChangeMiddleware::class])->group(function () {
        Route::get('carving/{carving}/edit', 'CarvingController@edit');
    });

    Route::post('/carving/{carving}/delete', 'CarvingController@delete');
    Route::post('carving/{carving}/update', 'CarvingController@update');
    Route::name('carving')->post('/carving', 'CarvingController@create');
    Route::post('/storage/delete/{file}', 'PhotoController@delete');

    Route::middleware([checkAdmin::class])->group(function () {
        Route::get('carving/print/all', 'CarvingController@downloadCarvingsForAll');
        Route::get('/tickets', 'HomeController@showTicket');

        Route::get('/gallery', 'GalleryController@index');

        Route::name('admin')->get('/admin', 'AdminController@viewDashboard');

        Route::get('/admin/user/{user}/edit', 'UserController@edit');
        Route::post('/admin/user/{user}/delete', 'UserController@delete');
        Route::get('/admin/user/downloadExcel', 'UserController@downloadExcel');

        Route::get('/admin/carving/{carving}/edit', 'CarvingController@edit');
        Route::post('/admin/carving/{carving}/delete', 'CarvingController@delete');
        Route::post('/admin/carving/{carving}/update', 'CarvingController@update');

        Route::get('/admin/payments', 'PaymentController@show');


//        Route::get('summernoteeditor', 'AdminController@getSummernoteeditor');
        Route::post('note', 'AdminController@saveNote');

    });

    Route::middleware([checkRoleJudgeMiddleware::class])->group(function () {
        //replacement
        Route::get('/carving/{carving}/award', 'CarvingController@editAward');
        Route::post('/carving/{carving}/award', 'CarvingController@saveAward');
    });


    //Uncomment when registration period is over
    Route::get('/gallery', 'GalleryController@index');
//    Route::get('/', 'GalleryController@welcome');
});