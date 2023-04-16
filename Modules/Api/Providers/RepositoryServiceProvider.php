<?php

namespace Modules\Api\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Api\Contracts\Repositories\Mysql\CategoryRepository;
use Modules\Api\Contracts\Repositories\Mysql\ProductRepository;
use Modules\Api\Contracts\Repositories\Mysql\TransactionProductRepository;
use Modules\Api\Contracts\Repositories\Mysql\TransactionRepository;
use Modules\Api\Contracts\Repositories\Mysql\UserRepository;
use Modules\Api\Repositories\Mysql\CategoryRepoImpl;
use Modules\Api\Repositories\Mysql\ProductRepoImpl;
use Modules\Api\Repositories\Mysql\TransactionProductRepoImpl;
use Modules\Api\Repositories\Mysql\TransactionRepoImpl;
use Modules\Api\Repositories\Mysql\UserRepoImpl;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repositories.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TransactionProductRepository::class, TransactionProductRepoImpl::class);
        $this->app->bind(TransactionRepository::class, TransactionRepoImpl::class);
        $this->app->bind(UserRepository::class, UserRepoImpl::class);
        $this->app->bind(CategoryRepository::class, CategoryRepoImpl::class);
        $this->app->bind(ProductRepository::class, ProductRepoImpl::class);
    }
}
