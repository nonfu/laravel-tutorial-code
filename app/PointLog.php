<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointLog extends Model
{
    const OPT_USER_REGISTER = 1;  // 用户注册
    const OPT_EMAIL_VERIFY = 2;   // 邮箱验证
    const OPT_USER_LOGIN = 3;     // 用户登录

    // 不同操作对应积分映射关系
    public static $OPT_POINT = [
        self::OPT_USER_REGISTER => 30,
        self::OPT_EMAIL_VERIFY => 20,
        self::OPT_USER_LOGIN => 5
    ];
}
