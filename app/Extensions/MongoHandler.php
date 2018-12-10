<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/28
 * Time: 6:11 PM
 */

namespace App\Extensions;

class MongoHandler implements \SessionHandlerInterface
{
    public function close()
    {
        // TODO: Implement close() method.
    }

    public function destroy($session_id)
    {
        // TODO: Implement destroy() method.
    }

    public function gc($maxlifetime)
    {
        // TODO: Implement gc() method.
    }

    public function open($save_path, $name)
    {
        // TODO: Implement open() method.
    }

    public function read($session_id)
    {
        // TODO: Implement read() method.
    }

    public function write($session_id, $session_data)
    {
        // TODO: Implement write() method.
    }

}