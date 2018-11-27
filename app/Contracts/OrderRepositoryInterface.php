<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/20
 * Time: 5:16 PM
 */

namespace App\Contracts;

use App\User;

interface OrderRepositoryInterface
{
    public function getMostRecent(User $user);
}