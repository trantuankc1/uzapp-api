<?php

use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\AuthController;
use Modules\Api\Http\Controllers\CategoryController;
use Modules\Api\Http\Controllers\ProductController;
use Modules\Api\Http\Controllers\StripePaymentController;
use Modules\Api\Http\Controllers\TransactionController;
use Modules\Api\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** @see AuthController::login() */
Route::post('login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('api::register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('test-auth', [AuthController::class, 'testAuth']);

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'productList'])->name('api::productByCategory');
        Route::get('/{id}', [ProductController::class, 'productDetail'])->name('api::productDetail');
    });

    Route::group(['prefix' => 'user'], function (){
        Route::get('/profile', [UserController::class, 'show'])->name('api::showUser');
        Route::put('/profile', [UserController::class, 'update'])->name('api::editUser');
    });
    Route::get('/category-list', [CategoryController::class, 'getList'])->name('api::categoryList');

    Route::prefix('transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'index']);
        Route::post('/create', [TransactionController::class, 'create']);
        Route::get('/{transNo}', [TransactionController::class, 'transactionDetail']);
        Route::get('payment-success/{retrieve}', [TransactionController::class, 'paymentSuccess']);
        Route::get('payment-cancel/{transNo}', [TransactionController::class, 'paymentCancel']);
    });

    Route::prefix('payment')->group(function () {
        Route::get('retrieve/{retrieve}', [StripePaymentController::class, 'retrieve']);
    });
});

//Debug
Route::get('debug', [\Modules\Api\Http\Controllers\DebugController::class, 'debug']);
