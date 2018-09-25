<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function getRouteKeyName() {
        return 'name';  // 以任务名称作为路由模型绑定查询字段
    }
}
