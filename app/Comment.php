<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    // 要触发更新的父级关联关系
    protected $touches = [
        'commentable'
    ];

    protected $fillable = [
        'content', 'user_id'
    ];

    const PENDING = 0; # 待审核
    const NORMAL = 1; # 正常

    public function commentable()
    {
        return $this->morphTo();
    }
}
