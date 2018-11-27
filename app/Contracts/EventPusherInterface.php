<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/21
 * Time: 3:01 PM
 */

namespace App\Contracts;


interface EventPusherInterface
{
    public function push($message, array $data = array());
}