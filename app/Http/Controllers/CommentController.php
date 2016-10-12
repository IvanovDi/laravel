<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Components\Like;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $comment)
    {
        $this->commentRepository = $comment;
    }

    public function editComment(Request $request, $id)  //todo переименовать на update. Сделать проверку на время
    {
        $comment  = $this->commentRepository->find($id);
        $comment->description = $request->get('description');
        $comment->edit = 1;
        $comment->save();
        return redirect()->back();
    }

    public function saveComment(Request $request, $post_id) //todo переименовать на store
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
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
        $like = new Like();
        $like->deleteCache($id);
        $comment = $this->commentRepository->find($id);
        $comment->likes()->toggle(\Auth::user()->id);
        return redirect()->back();
    }

}
