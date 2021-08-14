<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuctionItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'mainView']);

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//Admin
Route::get('/admin', [AdminController::class, 'loginView']);
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboardView']);
    Route::get('/admin/change-password', [AdminController::class, 'changePassword']);

    //Auction items
    Route::get('/auction-items/create', [AuctionItemController::class, 'create']);
    Route::post('/auction-items/store', [AuctionItemController::class, 'store']);
});
