<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notifications\SendMail;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function profile()
    {
        return view('post.profile');
    }

    public function editName(Request $request)
    {
        $user = \Auth::user();
        $user->name = $request['name'];
        $user->save();
        return redirect()->back();
    }

    public function editEmail(Request $request)
    {
        $user = \Auth::user();
        $url = route('comparison', ['token' => $user->token]);
        $user->notify(new SendMail($url));
        $user->email = $request['email'];
        $user->status = false;
        $user->save();
        return Redirect::back()->with('message','please confirm your email');
    }

    public function editPassword(Request $request)
    {
        $user = \Auth::user();
        if(Hash::check($request['confirmPassword'], \Auth::user()->password )) {
            $user->password = bcrypt($request['newPassword']);
            $user->save();//сделать отсылку письма

        }
        return redirect()->back();
    }
}
