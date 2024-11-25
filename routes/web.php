<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/browse', [App\Http\Controllers\BookController::class, 'browse'])->name('browse');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('book/suggest', [App\Http\Controllers\BookController::class, 'suggestBook'])->name('suggest-book');
Route::get('book/search', [App\Http\Controllers\BookController::class, 'search'])->name('search-book');

Route::get('/books-check', [App\Http\Controllers\BookController::class, 'booksCheck'])->name('books-check');

Route::group(['middleware' => ['auth']], function () {



    Route::prefix('dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard-index');
        Route::get('your-books', [App\Http\Controllers\DashboardController::class, 'yourBooks'])->name('your-books');
        Route::get('your-orders', [App\Http\Controllers\DashboardController::class, 'yourOrders'])->name('your-orders');
        Route::get('mini-search', [App\Http\Controllers\DashboardController::class, 'miniSearch'])->name('mini-search');
    });

    Route::prefix('book')->group(function () {
        Route::get('/submit-book', [App\Http\Controllers\BookController::class, 'submitBook'])->name('submit-book');
        Route::get('/redeem/{id}', [App\Http\Controllers\BookController::class, 'redeemBook'])->name('redeem-book');
        Route::post('/store-book', [App\Http\Controllers\BookController::class, 'storeBook'])->name('store-book');
        Route::post('/redeem-process', [App\Http\Controllers\BookController::class, 'redeemProcess'])->name('redeem-process');
    });

    Route::prefix('rider-dashboard')->group(function () {
        Route::get('/pending-pickup', [App\Http\Controllers\RiderDashboardController::class, 'pendingPickup'])->name('pending-pickup');
        Route::get('/update-status/{id}', [App\Http\Controllers\RiderDashboardController::class, 'updateStatus'])->name('update-status');
        Route::post('/update-status-process', [App\Http\Controllers\RiderDashboardController::class, 'updateStatusProcess'])->name('update-status-process');


        Route::get('/pending-delivery', [App\Http\Controllers\RiderDashboardController::class, 'pendingDelivery'])->name('pending-delivery');
        Route::get('/update-delivery-status/{id}', [App\Http\Controllers\RiderDashboardController::class, 'updateDeliveryStatus'])->name('update-delivery');
        Route::post('/update-delivery-status-process', [App\Http\Controllers\RiderDashboardController::class, 'updateDeliveryStatusProcess'])->name('update-delivery-status-process');
    });


    Route::prefix('logistics')->group(function () {
        Route::get('/pending-pickup', [App\Http\Controllers\LogisticsController::class, 'pendingPickup'])->name('pending-pickup');
        Route::get('/assign-collection/{id}', [App\Http\Controllers\LogisticsController::class, 'assignCollection'])->name('assign-collection');
        Route::post('/update-collection', [App\Http\Controllers\LogisticsController::class, 'updateCollectionProcess'])->name('update-collection');


        Route::get('/pending-delivery', [App\Http\Controllers\LogisticsController::class, 'pendingDelivery'])->name('pending-delivery');
        Route::get('/assign-delivery/{id}', [App\Http\Controllers\LogisticsController::class, 'assignDelivery'])->name('assign-delivery');




        Route::get('/update-status/{id}', [App\Http\Controllers\LogisticsController::class, 'updateStatus'])->name('update-status');
        Route::post('/update-status-process', [App\Http\Controllers\LogisticsController::class, 'updateStatusProcess'])->name('update-status-process');


        Route::get('/pending-delivery', [App\Http\Controllers\LogisticsController::class, 'pendingDelivery'])->name('pending-delivery');
        Route::get('/update-delivery-status/{id}', [App\Http\Controllers\LogisticsController::class, 'updateDeliveryStatus'])->name('update-delivery');
        Route::post('/update-delivery-status-process', [App\Http\Controllers\LogisticsController::class, 'updateDeliveryStatusProcess'])->name('update-delivery-status-process');
    });
});
