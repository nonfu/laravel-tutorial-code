<?php
namespace App\Services;

use App\Contracts\EventPusherInterface;
use App\Contracts\PusherSdkInterface;

class PusherEventPusher implements EventPusherInterface
{
    public function __construct(PusherSdkInterface $pusher)
    {
        $this->pusher = $pusher;
    }

    public function push($message, array $data = array())
    {
        // 通过 Pusher SDK 推送消息
    }
}