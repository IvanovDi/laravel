<?php

namespace App\Http\Controllers;

use App\Components\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Repositories\PostRepository;
use App\Repositories\Criteries\OrderCommentBy;
use App\Repositories\CommentRepository;
use App\Facades\Message;

class PostController extends Controller
{

    private $postRepository;
    private $commentRepository;
    private $path;

    public function __construct(PostRepository $post, CommentRepository $comment)
    {
        $this->postRepository = $post;
        $this->commentRepository = $comment;
        $this->path = 'def_img.jpg';
    }

    public function create()
    {
        return view('post.createPost');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'description' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $fileContent = file_get_contents($request->file('image')->getRealPath());
            $fileName = $request->file('image')->getClientOriginalName();
            Storage::disk('images')->put($fileName, $fileContent);
            $this->path = $request->file('image')->getClientOriginalName();
        }

        $this->postRepository->create([
            'user_id' => \Auth::user()->id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $this->path
        ]);
        return redirect('/');
    }

    public function show($id)
    {
        Message::setSuccess('litle bug');
        $like = new  Like();
        $post = $this->postRepository->find($id);
        $comment = $post->comments()->withCount('likes')->orderBy('created_at', 'DESC')->with('likes')->paginate(2);
        return view('post.post', ['post' => $post, 'comments' => $comment, 'like' => $like]);
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return redirect('/');
    }


}
