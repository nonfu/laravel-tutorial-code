<?php

namespace App;

use App\Events\UserDeleted;
use App\Events\UserDeleting;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, \Illuminate\Auth\MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dispatchesEvents = [
        'deleting' => UserDeleting::class,
        'deleted' => UserDeleted::class
    ];

    public function getDisplayNameAttribute()
    {
        return $this->nickname ? $this->nickname : $this->name;
    }

    public function setCardNoAttribute($value)
    {
        $value = str_replace(' ', '', $value);  // 将所有空格去掉
        $this->attributes['card_no'] = encrypt($value);
    }

    public function getCardNumAttribute()
    {
        if (!$this->card_no) {
            return '';
        }
        $cardNo = decrypt($this->card_no);
        $lastFour = mb_substr($cardNo, -4);
        return '**** **** **** ' . $lastFour;
    }

    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new EmailVerifiedAtScope());
        /*static::addGlobalScope('email_verified_at_scope', function (Builder $builder) {
            return $builder->whereNotNull('email_verified_at');
        });*/
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function pointLogs()
    {
        return $this->hasMany(PointLog::class);
    }
}
