<?php
use \App\Http\Middleware\AuthorizeCarvingChangeMiddleware;
use \App\Http\Middleware\checkAdmin;
use \App\Http\Middleware\AuthorizeUserChangeMiddleware;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/storage/{filename}', 'PhotoController@show');
    Route::post('/storage/delete/{file}', 'PhotoController@delete');


    Route::name('carving')->post('/carving', 'CarvingController@create');

    //User protected Routes
    Route::middleware([AuthorizeUserChangeMiddleware::class])->group(function() {
        Route::get('/carving/excel/{user}', 'CarvingController@downloadCarvingsForUser');
        Route::post('/user/{user}/record-payment', 'UserController@recordPayment');
        Route::get('/user/{user}/view-payments', 'UserController@viewPayments');
        Route::get('/user/{user}/edit', 'UserController@edit');
        Route::post('/user/{user}/update', 'UserController@update');
    });

    //Carving protected Routes
    Route::middleware([AuthorizeCarvingChangeMiddleware::class])->group(function() {
        Route::get('carving/{carving}/edit', 'CarvingController@edit');
        Route::post('/carving/{carving}/delete', 'CarvingController@delete');
        Route::post('carving/{carving}/update', 'CarvingController@update');
    });
});


Route::middleware(['auth', checkAdmin::class])->group(function () {
    Route::get('carving/print/all', 'CarvingController@downloadCarvingsForAll');
    Route::get('/tickets', 'HomeController@showTicket');

    Route::name('admin')->get('/admin', 'AdminController@viewDashboard');

    Route::get('/admin/user/{user}/edit', 'UserController@edit');
    Route::post('/admin/user/{user}/delete', 'UserController@delete');
    Route::get('/admin/user/downloadExcel', 'UserController@downloadExcel');

    Route::get('/admin/carving/{carving}/edit', 'CarvingController@edit');
    Route::post('/admin/carving/{carving}/delete', 'CarvingController@delete');
    Route::post('/admin/carving/{carving}/update', 'CarvingController@update');

    Route::get('/admin/payments', 'PaymentController@show');
});

Route::get('/test', function () {
    $num = 1;
    $sum = \App\Http\Controllers\HomeController::calcPrice($num);
    return new \Illuminate\Http\JsonResponse($sum);
});