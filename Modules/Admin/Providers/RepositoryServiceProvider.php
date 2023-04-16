<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Contracts\Repositories\Mysql\AdminLoginRepository;
use Modules\Admin\Contracts\Repositories\Mysql\AuthRepository;
use Modules\Admin\Contracts\Repositories\Mysql\CategoryRepository;
use Modules\Admin\Contracts\Repositories\Mysql\TransactionProductsRepository;
use Modules\Admin\Contracts\Repositories\Mysql\TransactionRepository;
use Modules\Admin\Contracts\Repositories\Mysql\ProductRepository;
use Modules\Admin\Contracts\Repositories\Mysql\UserRepository;
use Modules\Admin\Repositories\Mysql\AuthRepoImpl;
use Modules\Admin\Repositories\Mysql\CategoryRepoImpl;
use Modules\Admin\Repositories\Mysql\ProductRepoImpl;
use Modules\Admin\Repositories\Mysql\TransactionProductRepoImpl;
use Modules\Admin\Repositories\Mysql\TransactionRepoImpl;
use Modules\Admin\Repositories\Mysql\UserRepoImpl;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repositories.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepoImpl::class);
        $this->app->bind(CategoryRepository::class, CategoryRepoImpl::class);
        $this->app->bind(ProductRepository::class, ProductRepoImpl::class);
        $this->app->bind(TransactionRepository::class, TransactionRepoImpl::class);
        $this->app->bind(TransactionProductsRepository::class, TransactionProductRepoImpl::class);
        $this->app->bind(AuthRepository::class, AuthRepoImpl::class);
    }
}
