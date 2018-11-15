<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/15
 * Time: 5:45 PM
 */

namespace App\Contracts;


interface BillerInterface
{
    public function bill(array $user, $amount);
}