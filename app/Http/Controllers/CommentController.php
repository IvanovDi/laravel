<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Components\Like;
use App\Notifications\InfoOfNewComment;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use Carbon\Carbon;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $comment)
    {
        $this->commentRepository = $comment;
    }

    public function editComment(Request $request, $id)
    {
        if(Carbon::now() < Carbon::parse($this->commentRepository->find($id)->created_at)->addMinutes(10)) {
            $comment  = $this->commentRepository->find($id);
            $comment->description = $request->get('description');
            $comment->edit = 1;
            $comment->save();
        }
        return redirect()->back();

    }

    public function saveComment(Request $request, $post_id)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $user = Auth::user();
        Comment::create([
            'description' => $request->get('description'),
            'user_id' => $user->id,
            'post_id' => $post_id,
            'edit' => 0
        ]);
        $user->notify(new InfoOfNewComment());
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
