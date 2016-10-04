<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
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
