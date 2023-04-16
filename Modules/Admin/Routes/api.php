<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\ProductController;
use Modules\Admin\Http\Controllers\UserController;

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
Route::prefix('admin')->group(function () {
    Route::group(['prefix' => 'products'], function () {
        Route::get('/change-status/{id}', 'ProductController@changeStatus')->name('admin::api.product.changeStatus');
        Route::post('/upload-img', 'ProductController@uploadImg')->name('admin::api.product.uploadImg');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin::api.product.delete');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/change-status/{id}', 'CategoryController@changeStatus')->name('admin::api.category.changeStatus');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/show/{id}', [UserController::class, 'show'])->name('admin::users.show');
    });

});
