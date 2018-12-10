<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $casts = [
        'hobby' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
