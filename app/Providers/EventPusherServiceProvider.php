<?php

namespace App\Providers;

use App\Contracts\EventPusherInterface;
use App\Contracts\PusherSdkInterface;
use App\Services\PusherEventPusher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Pusher\Pusher;

class EventPusherServiceProvider extends ServiceProvider
{
    public function register()
    {

    }
}