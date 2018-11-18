<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/16
 * Time: 5:58 PM
 */

namespace App\Services;
use App\Contracts\BillingNotifierInterface;

class EmailBillingNotifier implements BillingNotifierInterface
{
    public function notify(array $user, $amount)
    {
        // TODO: Implement notify() method.
    }
}