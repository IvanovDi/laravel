<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Comment extends Model
{
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];

    protected $visible = [
        'post_id',
        'description',
        'user_id',
        'edit'
    ];

    protected $fillable = [
        'post_id',
        'description',
        'user_id',
        'edit'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
