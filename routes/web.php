<?php

use \App\Http\Middleware\AuthorizeCarvingChangeMiddleware;
use \App\Http\Middleware\checkAdmin;
use \App\Http\Middleware\AuthorizeUserChangeMiddleware;
use \App\Http\Middleware\checkRoleJudgeMiddleware;

$client = new \Aws\S3\S3Client([
    'version' => 'latest',
    'region'  =>  'nyc3',
    'endpoint' => 'nyc3.digitaloceanspaces.com',
    'credentials' => [
        'key'    => 'Q5SYAYGCHBZVDTBYXCBW',
        'secret' => 'EoBMPCEOvpiZa2fMoT5TRVaoygpITX2q44RvO2KCnHE',
    ],
]);

$client->putObject([
    'Bucket' => 'entryform3',
    'Key'    => 'file.ext',
    'Body'   => 'The contents of the file.',
    'ACL'    => 'private'
]);

die;

\Illuminate\Support\Facades\Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('/storage/{filename}', 'PhotoController@show');
Route::get('/storage/{filename}/{size}', 'PhotoController@showWithSize');

Route::get('/gallery/download/photo/{carving}', 'GalleryController@downloadImage');

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');


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
});


Route::middleware(['auth', checkRoleJudgeMiddleware::class])->group(function () {
    //replacement
    Route::get('/carving/{carving}/award', 'CarvingController@editAward');
    Route::post('/carving/{carving}/award', 'CarvingController@saveAward');
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


//load once the registraiton period is over
//Route::get('/', 'GalleryController@welcome');
Route::get('/gallery', 'GalleryController@index');

Route::get('/jacob', function() {

    $client = new \Aws\S3\S3Client([
        'version' => 'latest',
        'region'  =>  'nyc3',
        'endpoint' => 'nyc3.digitaloceanspaces.com',
        'credentials' => [
            'key'    => 'Q5SYAYGCHBZVDTBYXCBW',
            'secret' => 'EoBMPCEOvpiZa2fMoT5TRVaoygpITX2q44RvO2KCnHE',
        ],
    ]);

    $client->putObject([
        'Bucket' => 'entryform3',
        'Key'    => 'file.ext',
        'Body'   => 'The contents of the file.',
        'ACL'    => 'private'
    ]);
});