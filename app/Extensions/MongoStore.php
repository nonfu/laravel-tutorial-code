<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/28
 * Time: 5:42 PM
 */

namespace App\Extensions;


use Illuminate\Contracts\Cache\Store;

class MongoStore implements Store
{
    public function get($key)
    {
        // TODO: Implement get() method.
    }

    public function many(array $keys)
    {
        // TODO: Implement many() method.
    }

    public function put($key, $value, $minutes)
    {
        // TODO: Implement put() method.
    }

    public function putMany(array $values, $minutes)
    {
        // TODO: Implement putMany() method.
    }

    public function increment($key, $value = 1)
    {
        // TODO: Implement increment() method.
    }

    public function decrement($key, $value = 1)
    {
        // TODO: Implement decrement() method.
    }

    public function forever($key, $value)
    {
        // TODO: Implement forever() method.
    }

    public function forget($key)
    {
        // TODO: Implement forget() method.
    }

    public function flush()
    {
        // TODO: Implement flush() method.
    }

    public function getPrefix()
    {
        // TODO: Implement getPrefix() method.
    }

}