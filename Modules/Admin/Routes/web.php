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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\CategoryController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\TransactionController;
use Modules\Admin\Http\Controllers\TransactionProductController;
use Modules\Admin\Http\Controllers\Auth\LoginController;
use Modules\Admin\Http\Controllers\Auth\LogOutController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('admin::login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('admin::postLogin');
    Route::get('/logout', [LogOutController::class, 'logout'])->name('admin::logout');

    Route::middleware('checkLoginAdmin')->group(function () {
        Route::get('/set-language/{locale}', function ($locale) {
            if (!in_array($locale, ['en', 'vi', 'jp'])) {
                abort(400);
            }
            App::setLocale($locale);
            session()->put('locale', $locale);
            return redirect()->back();
        })->name('switch.language');

        Route::get('/', [TransactionController::class, 'index']);
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category');
            Route::get('/search', [CategoryController::class, 'search'])->name('search');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/create', [CategoryController::class, 'store'])->name('create');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('admin::categoryUpdate');
            Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin::categoryDelete');
        });
        Route::prefix('order')->group(function () {
            Route::get('/', [TransactionController::class, 'index'])->name('order');
            Route::get('/search', [TransactionController::class, 'index'])->name('search');
            Route::get('/order-detail/{id}', [TransactionController::class, 'show'])->name('orderDetail');
            Route::post('/status-order-detail', [TransactionProductController::class, 'change'])->name('changeStatus');
            Route::get('/total-money', [TransactionController::class, 'totalMoney'])->name('totalMoney');
            Route::get('/export-csv', [TransactionProductController::class, 'exportCsv'])->name('export-csv');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductController@index')->name('admin::product.index');
            Route::get('/create', 'ProductController@create')->name('admin::product.create');
            Route::post('/store', 'ProductController@store')->name('admin::product.store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('admin::product.edit');
            Route::post('/update/{id}', 'ProductController@update')->name('admin::product.update');
            Route::get('/exportCSV', 'ProductController@exportCSV')->name('admin::product.exportCSV');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin::users.index');
            Route::post('/show', [UserController::class, 'show'])->name('admin::users.show');
            Route::post('/edit', [UserController::class, 'show'])->name('admin::users.edit');
            Route::get('/profile/{id}', [UserController::class, 'profileUser'])->name('admin::user.profile');
            Route::patch('/update', [UserController::class, 'update'])->name('admin::users.update');
            Route::get('/search', [UserController::class, 'search'])->name('admin::users.search');
            Route::get('/search', [UserController::class, 'search'])->name('admin::users.search');

            Route::get('/exportCSV', [UserController::class, 'exportCSV'])->name('admin::users.exportCSV');
        });
    });
});




