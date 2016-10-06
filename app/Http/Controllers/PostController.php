<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
    {
        return view('post.createPost');
    }

    public function save(Request $request)
    {
        $path = 'def_img.jpg';
        if($request->image) {
            Storage::disk('images')->put(
                $request->file('image')->getClientOriginalName(),
                file_get_contents($request->file('image')->getRealPath())
            );
            $path = $request->file('image')->getClientOriginalName();
        }

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $path
        ]);

        return redirect('/');
    }

    public function showPost($id)
    {
        $post = Post::findOrFail($id);
        $comment = $post->comments()->orderBy('id', 'DESC')->paginate(2);
        return view('post.post', ['post' => $post, 'comments' => $comment]);
    }

    public function addComment($id)
    {
        return view('post.addComment', ['id' => $id]);
    }

    public function editComment(Request $request, $id)
    {

        $comment  = Comment::find($id);
        $comment->description = $request['description'];
        $comment->edit = 1;
        $comment->save();
        return redirect('/');
    }


    public function deletePost($id)
    {
        Post::destroy($id);
        return redirect('/');
    }

    public function likeComment($id)
    {
        if (\Auth::check()) {
            $comment = Comment::find($id);
                $comment->likes()->toggle(\Auth::user()->id);
        }
        return redirect()->back();
    }

}
