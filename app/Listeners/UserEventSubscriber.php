<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use App\Events\UserDeleting;
use App\PointLog;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;

class UserEventSubscriber
{
    /**
     * 处理用户删除前事件
     */
    public function onUserDeleting($event) {
        Log::info('用户即将删除[' . $event->user->id . ']:' . $event->user->name);
    }

    /**
     * 处理用户删除后事件
     */
    public function onUserDeleted($event) {
        Log::info('用户已经删除[' . $event->user->id . ']:' . $event->user->name);
    }

    /**
     * 处理用户注册事件
     * @param $event
     */
    public function onUserRegistered($event) {
        // 用户注册成功后初始积分为30
        $event->user->point += PointLog::$OPT_POINT[PointLog::OPT_USER_REGISTER];
        $event->user->save();
        // 保存积分变更日志
        $pointLog = new PointLog();
        $pointLog->type = PointLog::OPT_USER_REGISTER;
        $pointLog->value = PointLog::$OPT_POINT[PointLog::OPT_USER_REGISTER];
        $event->user->pointLogs()->save($pointLog);
    }

    /**
     * 处理验证邮箱事件
     * @param $event
     */
    public function onEmailVerified($event) {
        // 用户验证邮箱后增加20积分
        $event->user->point += PointLog::$OPT_POINT[PointLog::OPT_EMAIL_VERIFY];
        $event->user->save();
        // 保存积分变更日志
        $pointLog = new PointLog();
        $pointLog->type = PointLog::OPT_EMAIL_VERIFY;
        $pointLog->value = PointLog::$OPT_POINT[PointLog::OPT_EMAIL_VERIFY];
        $event->user->pointLogs()->save($pointLog);
    }

    /**
     * 处理用户登录事件
     * @param $event
     */
    public function onUserLogin($event) {
        $pointLog = PointLog::where('user_id', $event->user->id)->where('type', PointLog::OPT_USER_LOGIN)->orderBy('created_at', 'desc')->first();
        $firstLoginToday = false;
        if (!$pointLog) {
            // 注册后首次登录
            $firstLoginToday = true;
        } else {
            $lastLoginTime = new Carbon($pointLog->created_at);
            if ($lastLoginTime->isYesterday()) {
                // 上次登录时间是昨天
                $firstLoginToday = true;
            }
        }
        if ($firstLoginToday) {
            // 用户每日首次登录成功后增加5积分
            $event->user->point += PointLog::$OPT_POINT[PointLog::OPT_USER_LOGIN];
            $event->user->save();
            // 保存积分变更日志
            $pointLog = new PointLog();
            $pointLog->type = PointLog::OPT_USER_LOGIN;
            $pointLog->value = PointLog::$OPT_POINT[PointLog::OPT_USER_LOGIN];
            $event->user->pointLogs()->save($pointLog);
        }
    }

    /**
     * 为订阅者注册监听器
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            UserDeleting::class,
            UserEventSubscriber::class . '@onUserDeleting'
        );

        $events->listen(
            UserDeleted::class,
            UserEventSubscriber::class . '@onUserDeleted'
        );

        $events->listen(
            Registered::class,
            UserEventSubscriber::class . '@onUserRegistered'
        );

        $events->listen(
            Verified::class,
            UserEventSubscriber::class . '@onEmailVerified'
        );

        $events->listen(
            Login::class,
            UserEventSubscriber::class . '@onUserLogin'
        );
    }
}
