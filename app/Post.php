<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    const DRAFT = 0;
    const ACTIVED = 1;

    const ARTICLE = 1;
    const PAGE = 2;

    protected $guarded = ['user_id'];

    public function scopePopular(Builder $query)
    {
        return $query->where('views', '>', '0')->orderBy('views', 'desc');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', Post::ACTIVED);
    }

    public function scopeOfType(Builder $query, $type)
    {
        return $query->where('type', $type);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'author')
            ->withDefault([
                'id' => 0,
                'name' => '游客用户',
            ]);
    }

    /*public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags')->using(PostTag::class);
    }*/

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
