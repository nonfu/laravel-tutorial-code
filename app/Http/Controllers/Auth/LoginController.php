<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    // 单位时间内最大登录尝试次数
    //protected $maxAttempts = 3;
    // 单位时间值
    //protected $decayMinutes = 30;

    // 支持的登录字段
    protected $supportFields = ['name', 'email'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function username()
    {
        return 'name';
    }*/

    // 将支持的登录字段都传递到 UserProvider 进行查询
    public function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        foreach ($this->supportFields as $field) {
            if (empty($credentials[$field])) {
                $credentials[$field] = $credentials[$this->username()];
            }
        }
        return $credentials;
    }

    public function personal()
    {
        $user = User::where('name', '学院君')->first();
        $token = $user->createToken('Users')->accessToken;
        dd($token);
    }
}
