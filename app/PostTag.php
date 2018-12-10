<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/12/6
 * Time: 12:31 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    protected $table = 'post_tags';
}