<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\StripePaymentController;


Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

Route::get('checkout', [StripePaymentController::class, 'checkout']);
Route::post('checkout', [StripePaymentController::class, 'post']);

Route::get('checkout-demo', [StripePaymentController::class, 'getViewCheckout']);
Route::post('checkout-demo', [StripePaymentController::class, 'post']);
Route::get('payment-demo', [StripePaymentController::class, 'payment']);
Route::get('retrieve-demo/{retrieve}', [StripePaymentController::class, 'retrieve']);

