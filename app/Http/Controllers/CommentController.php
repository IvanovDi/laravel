<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Comment;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function editComment(Request $request, $id)
    {
        $comment  = Comment::find($id);
        $comment->description = $request['description'];
        $comment->edit = 1;
        $comment->save();
        return redirect()->back();
    }

    public function saveComment(Request $request, $post_id)
    {
        Comment::create([
            'description' => $request->get('description'),
            'user_id' => Auth::user()->id,
            'post_id' => $post_id,
            'edit' => 0
        ]);
        return redirect()->back();
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