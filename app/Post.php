<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Post extends Model
{
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];

    protected $visible = [
        'user_id',
        'title',
        'description',
        'image'

    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
