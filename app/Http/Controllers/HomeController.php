<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Pagination;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::withCount('comments')->paginate(2);
        return view('post.index', ['post' => $post]);
    }
}
