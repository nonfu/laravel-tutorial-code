<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function saving(User $user)
    {
        Log::info('即将保存用户到数据库[' . $user->id . ']' . $user->name);
    }

    public function creating(User $user)
    {
        Log::info('即将插入用户到数据库[' . $user->id . ']' . $user->name);
    }

    public function updating(User $user)
    {
        Log::info('即将更新用户到数据库[' . $user->id . ']' . $user->name);
    }

    public function updated(User $user)
    {
        Log::info('已经更新用户到数据库[' . $user->id . ']' . $user->name);
    }

    public function created(User $user)
    {
        Log::info('已经插入用户到数据库[' . $user->id . ']' . $user->name);
    }

    public function saved(User $user)
    {
        Log::info('已经保存用户到数据库[' . $user->id . ']' . $user->name);
    }
}
