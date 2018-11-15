<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/15
 * Time: 5:46 PM
 */

namespace App\Contracts;


interface BillingNotifierInterface
{
    public function notify(array $user, $amount);
}