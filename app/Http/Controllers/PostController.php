<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Repositories\Criteries\CommentBy;
use Composer\Repository\RepositoryInterface;
use Illuminate\Http\Request;
use App\Post;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PostRepository as PostRepo;
use App\Repositories\Criteries\Order;
use App\Repositories\CommentRepository as CommentRepo;

class PostController extends Controller
{

    private $postRepository;
    private $commentRepository;

    public function __construct(PostRepo $post, CommentRepo $comment)
    {
        $this->postRepository = $post;
        $this->commentRepository = $comment;
    }

    public function index()
    {
        $post = $this->postRepository->pushCriteria(new Order())->paginate(3);
        return view('post.index', ['post' => $post]);

    }

    public function create()
    {
        return view('post.createPost');
    }

    public function save(Request $request)
    {
        $path = 'def_img.jpg';
        if($request->file('image')) {
            $fileContent = file_get_contents($request->file('image')->getRealPath());
            $fileName = $request->file('image')->getClientOriginalName();
            Storage::disk('images')->put($fileName, $fileContent);
            $path = $request->file('image')->getClientOriginalName();
        }

        $this->postRepository->create([
            'user_id' => Auth::user()->id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $path
        ]);
        return redirect('/');
    }

    public function showPost($id)
    {
        $post = $this->postRepository->find($id);
        $comment = $post->comments()->orderBy('created_at', 'DESC')->paginate(2);
        return view('post.post', ['post' => $post, 'comments' => $comment]);
    }

    public function deletePost($id)
    {
        $this->postRepository->delete($id);
        return redirect('/');
    }

    public function likeComment($id)
    {
        if (\Auth::check()) {
            $comment = $this->commentRepository->find($id);
                $comment->likes()->toggle(\Auth::user()->id);
        }
        return redirect()->back();
    }



}
