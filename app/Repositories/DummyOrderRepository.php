<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/20
 * Time: 5:19 PM
 */

namespace QuickBill\Repositories;

use App\Contracts\OrderRepositoryInterface;
use App\User;

class DummyOrderRepository implements OrderRepositoryInterface
{
    public function getMostRecent(User $user)
    {
        return ['Order 1', 'Order 2', 'Order 3'];
    }
}