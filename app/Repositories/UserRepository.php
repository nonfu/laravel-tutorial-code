<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/15
 * Time: 4:43 PM
 */

namespace QuickBill\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{

    public function all(): array
    {
        return User::all()->toArray();
    }
}