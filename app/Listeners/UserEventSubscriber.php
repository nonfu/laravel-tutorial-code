<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use App\Events\UserDeleting;
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
    }
}
