<?php

namespace Modules\Api\Providers;

use App\Adapters\Clients\StorageClient;
use App\Adapters\Clients\StorageClientImpl;
use App\Adapters\Stripes\StripePayment;
use App\Adapters\Stripes\StripePaymentImpl;
use App\Securities\Authentications\AuthenticationManager;
use App\Securities\Authentications\BasicAuthenticationManager;
use Illuminate\Support\ServiceProvider;
use Modules\Api\Contracts\Services\AuthService;
use Modules\Api\Contracts\Services\CategoryService;
use Modules\Api\Contracts\Services\PaymentService;
use Modules\Api\Contracts\Services\ProductService;
use Modules\Api\Contracts\Services\TransactionProductService;
use Modules\Api\Contracts\Services\TransactionService;
use Modules\Api\Contracts\Services\UserService;
use Modules\Api\Services\AuthServiceImpl;
use Modules\Api\Services\CategoryServiceImpl;
use Modules\Api\Services\PaymentServiceImpl;
use Modules\Api\Services\ProductServiceImpl;
use Modules\Api\Services\TransactionProductServiceImpl;
use Modules\Api\Services\TransactionServiceImpl;
use Modules\Api\Services\UserServiceImpl;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PaymentService::class, PaymentServiceImpl::class);
        $this->app->bind(StripePayment::class, StripePaymentImpl::class);
        $this->app->bind(TransactionProductService::class, TransactionProductServiceImpl::class);
        $this->app->bind(TransactionService::class, TransactionServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);
        $this->app->bind(ProductService::class, ProductServiceImpl::class);
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(StorageClient::class, StorageClientImpl::class);
        $this->app->bind(AuthenticationManager::class, BasicAuthenticationManager::class);
    }
}
