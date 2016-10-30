<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Components\Like;
use App\Notifications\InfoOfNewComment;
use App\Notifications\SendNewComment;
use App\Post;
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
        $user = Post::find($post_id)->user;
        $this->validate($request, [
            'description' => 'required'
        ]);
        Comment::create([
            'description' => $request->get('description'),
            'user_id' => $user->id,
            'post_id' => $post_id,
            'edit' => 0
        ]);
        $sum = count($user->unreadNotifications) + 1;
        $user->notify(new InfoOfNewComment());
        $user->notify(new SendNewComment($sum, route('post.show', $post_id)));
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
