<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use App\Http\Requests;
use App\Repositories\Criteries\OrderCommentBy;

class HomeController extends Controller
{
    private $postRepository;

    public function __construct(PostRepository $post)
    {
        $this->postRepository = $post;
    }

    public function index()
    {
        $post = $this->postRepository->pushCriteria(new  OrderCommentBy())->paginate(3);

        return view('post.index', ['post' => $post]);

    }
}
