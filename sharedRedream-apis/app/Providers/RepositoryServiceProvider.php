<?php

namespace App\Providers;

use App\Repositories\Impl\{
    IncidentRepositoryInterface,
    RedeemVoucherRepositoryInterface,
    TransactionRepositoryInterface,
    UserRepositoryInterface,
    WalletRepositoryInterface
};
use App\Repositories\{
    IncidentRepository,
    RedeemVoucherRepository,
    TransactionRepository,
    UserRepository,
    WalletRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IncidentRepositoryInterface::class,
            IncidentRepository::class
        );

        $this->app->bind(
            RedeemVoucherRepositoryInterface::class,
            RedeemVoucherRepository::class
        );

        $this->app->bind(
            TransactionRepositoryInterface::class,
            TransactionRepository::class
        );
        
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        
        $this->app->bind(
            WalletRepositoryInterface::class,
            WalletRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
