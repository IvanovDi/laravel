<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use  Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function create()
    {
        return view('post.createPost');
    }

    public function save(Request $request)
    {
//        $this->validate($request, [
//            'title' => 'required|unique:posts|max:255',
//            'content' => 'required',
//        ]);
        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'description' => $request['description']
        ]);

        return redirect('/');
    }

    public function showPost($id)
    {
        return view('post.post', ['post' => Post::findOrFail($id)]);
    }

    public function addComment($id)
    {
        return view('post.addComment', ['id' => $id]);
    }

    public function saveComment(Request $request, $id)
    {
        Comment::create([
            'description' => $request['description'],
            'user_id' => Auth::user()->id,
            'post_id' => $id
        ]);
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
            if ($comment->likes()->find(\Auth::user()->id)) {
                $comment->likes()->detach(\Auth::user()->id);
            } else {
                $comment->likes()->attach(\Auth::user()->id);
            }
        }
        return redirect()->back();
    }
}
