<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/15
 * Time: 4:43 PM
 */

namespace App\Contracts;


interface UserRepositoryInterface
{
    public function all(): array;
}