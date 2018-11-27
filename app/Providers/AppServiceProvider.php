<?php

namespace App\Providers;

use App\Contracts\BillerInterface;
use App\Contracts\BillingNotifierInterface;
use App\Contracts\OrderRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\DummyOrderRepository;
use App\Repositories\UserRepository;
use App\Services\EmailBillingNotifier;
use App\Services\SmsBillingNotifier;
use App\Services\StripeBiller;
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

        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository();
        });

        // 延迟实例化
        $this->app->bind(BillerInterface::class, function ($app) {
            return new StripeBiller($app->make(BillingNotifierInterface::class));
        });

        // 立即实例化
        //$this->app->bind(BillingNotifierInterface::class, StripeBiller::class);

        $notifier = new SmsBillingNotifier;
        $this->app->instance(BillingNotifierInterface::class, $notifier);

        $this->app->bind(OrderRepositoryInterface::class, function ($app) {
            return new DummyOrderRepository();
        });
    }
}
