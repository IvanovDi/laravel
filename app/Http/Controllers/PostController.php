<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use  Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

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

    public function saveComment(Request $request, $id)
    {
        Comment::create([
            'description' => $request['description'],
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'edit' => 0
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
                $comment->likes()->toggle(\Auth::user()->id);
        }
        return redirect()->back();
    }

    public function profile()
    {
        return view('post.profile');
    }

    public function editName(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->save();
        return redirect()->back();
    }

    public function editEmail(Request $request, $id)
    {
        $user = User::find($id);
        if($user->email === $request['confirmEmail']) {
            $user->email = $request['email'];
        }
        $user->save();
        return redirect()->back();
    }

    public function editPassword(Request $request, $id)
    {
        $user = User::find($id);
        if(Hash::check($request['confirmPassword'], \Auth::user()->password )) {
            $user->password = bcrypt($request['newPassword']);
            $user->save();
            Mail::raw('Текст письма', function ($message) {
                $message->from('us@example.com', 'Laravel');

                $message->to('foo@example.com')->cc('bar@example.com');
            });
        }
        return redirect()->back();

    }
}
