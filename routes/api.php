<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
\Laravel\Passport\Passport::$ignoreCsrfToken = true;

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        if ($user->tokenCan('all-user-info')) {
            // 如果用户令牌有获取所有信息权限，返回所有用户字段
            return $user;
        }
        // 否则返回用户名和邮箱等基本信息
        return ['name' => $user->name, 'email' => $user->email];
    })->middleware('scope:basic-user-info,all-user-info');
    Route::get('/post/{id}', function (Request $request, $id) {
        return \App\Post::find($id);
    })->middleware('scopes:get-post-info');
    Route::get('/user/{id}', function ($id) {
        return \App\User::find($id);
    });
});

Route::middleware('client')->get('/test', function (Request $request) {
    return '欢迎访问 Laravel 学院!';
});
