<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Contracts\Services\AdminLoginService;
use Modules\Admin\Contracts\Services\AuthService;
use Modules\Admin\Contracts\Services\CategoryService;
use Modules\Admin\Contracts\Services\ProductService;
use Modules\Admin\Contracts\Services\TransactionProductsService;
use Modules\Admin\Contracts\Services\TransactionService;
use Modules\Admin\Contracts\Services\UserService;
use Modules\Admin\Services\AuthServiceImpl;
use Modules\Admin\Services\CategoryServiceImpl;
use Modules\Admin\Services\ProductServiceImpl;
use Modules\Admin\Services\TransactionProductsServiceImpl;
use Modules\Admin\Services\TransactionServiceImpl;
use Modules\Admin\Services\UserServiceImpl;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);
        $this->app->bind(ProductService::class, ProductServiceImpl::class);
        $this->app->bind(TransactionService::class, TransactionServiceImpl::class);
        $this->app->bind(TransactionProductsService::class, TransactionProductsServiceImpl::class);
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
    }
}
