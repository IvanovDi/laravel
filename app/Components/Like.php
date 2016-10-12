<?php

namespace App\Components;

use App\Comment;

class Like extends BaseCacheComponent
{
    public $likes = [];

    public function getDataForCache()
    {
        $comments = Comment::withCount('likes')->get();
        foreach ($comments as $comment) {
            $this->likes['comment_' . $comment->id] =  $comment->likes_count;
        }
        return $this->likes;
    }
}