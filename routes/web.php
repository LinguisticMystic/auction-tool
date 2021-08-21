<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuctionItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QRController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'mainView']);
Route::get('/thanks', [HomeController::class, 'thanksPage']); //needs middleware!!!!!!!!!!!!!!!!!!!!!!

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//Admin
Route::get('/admin', [AdminController::class, 'loginView']);    //needs middleware!!!!!!!!!!!!!!!!!!!!!!
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboardView']);
    Route::get('/admin/change-password', [AdminController::class, 'changePassword']);

    //Auction items
    Route::get('/auction-items/create', [AuctionItemController::class, 'create']);
    Route::post('/auction-items/store', [AuctionItemController::class, 'store']);
    Route::get('/auction-items/{id}/edit', [AuctionItemController::class, 'edit']);
    Route::post('/auction-items/{id}/update', [AuctionItemController::class, 'update']);
    Route::post('/auction-items/{id}/destroy', [AuctionItemController::class, 'destroy']);

    //QR
    Route::get('/auction-items/{id}/qr', [QRController::class, 'qr']);

    //Booking
    Route::get('/bookings', [BookingController::class, 'index']);
});

Route::get('/auction-items/{id}', [AuctionItemController::class, 'show']);

//Bids
Route::post('/bids/store', [BidController::class, 'store']);
Route::post('/bids/{id}/destroy', [BidController::class, 'destroy']);

//Booking
Route::get('/auction-items/{id}/book', [BookingController::class, 'book']);
Route::post('/auction-items/{id}/book/store', [BookingController::class, 'store']);
