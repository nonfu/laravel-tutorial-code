<?php

namespace App\Providers;

use App\Extentions\EloquentUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 通过自定义的 EloquentUserProvider 覆盖系统默认的
        Auth::provider('eloquent', function ($app, $config) {
            return new EloquentUserProvider($app->make('hash'), $config['model']);
        });

        // OAuth 相关路由
        Passport::routes();

        // 启用隐式授权令牌
        Passport::enableImplicitGrant();

        // 令牌作用域
        Passport::tokensCan([
            'basic-user-info' => '获取用户名、邮箱信息',
            'all-user-info' => '获取用户所有信息',
            'get-post-info' => '获取文章详细信息',
        ]);
    }

}
