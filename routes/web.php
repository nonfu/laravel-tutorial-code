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

Route::get('/', function () {
    return "Hello, World!";
});

// 路由参数
Route::get('user/{id?}', function ($id = 1) {
    return "用户ID: " . $id;
})->name('user.profile');

Route::get('page/{id}', function ($id) {
    return '页面ID: ' . $id;
})->where('id', '[0-9]+');

Route::get('page/{name}', function ($name) {
    return '页面名称: ' . $name;
})->where('username', '[A-Za-z]+');

Route::get('page/{id}/{slug}', function ($id, $slug) {
    return $id . ':' . $slug;
})->where(['id' => '[0-9]+', 'slug' => '[A-Za-z]+']);

// 路由分组
Route::group([], function () {
    Route::get('hello', function () { return 'Hello'; });
    Route::get('world', function () { return 'World'; });
});

// 中间件
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    });
    Route::get('account', function () {
        return view('account');
    });
});

// 路由前缀
Route::prefix('api')->group(function () {
    Route::get('/', function () {
        // 处理 /api 路由
    })->name('api.index');
    Route::get('users', function () {
        // 处理 /api/users 路由
    })->name('api.users');
});

// 子域名
Route::domain('api.blog.test')->group(function () {
    Route::get('/', function () {
        // 处理 http://api.blog.test 路由
    });
});

Route::domain('{account}.blog.test')->group(function () {
    Route::get('/', function ($account) {
        //
    });
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});

// 命名空间

// 路由命名+路径前缀
Route::name('user.')->prefix('user')->group(function () {
    Route::get('{id?}', function ($id = 1) {
        // 处理 /user/{id} 路由，路由命名为 user.show
        return route('user.show');
    })->name('show');
    Route::get('posts', function () {
        // 处理 /user/posts 路由，路由命名为 user.posts
    })->name('posts');
});

Route::get('test', function () {
    return route('user.show', [100]);
});