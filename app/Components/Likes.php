<?php

namespace App\Components;

use App\Repositories\CommentRepository;

class Like extends BaseCacheComponent
{
    protected $cacheName = 'likes';
    public $likes = [];
    protected $commentRepository;

     public function __construct(CommentRepository $comment)
     {
         $this->commentRepository = $comment;
     }

    public function getDataForCache()
    {
        $comments = $this->commentRepository->get();
        foreach ($comments as $comment) {
            $this->likes['comment_' . $comment->id] =  $comment->withCount('likes')->all();
        }
        return $this->likes;
    }
}