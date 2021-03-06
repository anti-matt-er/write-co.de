<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'post_id',
        'reply_to',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function prompt()
    {
        return $this->belongsTo('App\Comment', 'reply_to');
    }

    public function replies()
    {
        return $this->hasMany('App\Comment', 'reply_to')->whereNotNull('published_at');
    }
}
