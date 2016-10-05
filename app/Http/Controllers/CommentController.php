<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Comment;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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

    public function saveComment(Request $request, $id)
    {
        Comment::create([
            'description' => $request->get('description'),
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'edit' => 0
        ]);
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
