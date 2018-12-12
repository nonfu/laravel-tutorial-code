<?php

namespace App\Providers;

use App\Contracts\BillerInterface;
use App\Contracts\BillingNotifierInterface;
use App\Contracts\OrderRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\DummyOrderRepository;
use App\Repositories\UserRepository;
use App\Services\EmailBillingNotifier;
use App\Extensions\MongoStore;
use App\Services\SmsBillingNotifier;
use App\Services\StripeBiller;
use Illuminate\Cache\CacheManager;
use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('siteName', 'Laravel学院');
        view()->share('siteUrl', 'https://laravelacademy.org');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
