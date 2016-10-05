<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Pagination;
use Illuminate\Auth;
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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('id', 'DESC')->paginate(2);
        return view('post.index', ['post' => $post]);
    }
}
