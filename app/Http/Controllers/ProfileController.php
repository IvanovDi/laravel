<?php

namespace App\Http\Controllers;

use App\Notifications\SendMail;
use App\Notifications\SendMessage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.profile');
    }

    public function editName(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $user = \Auth::user();
        $user->name = $request->get('name');
        $user->save();
        return redirect()->back();
    }

    public function editEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users'
        ]);
        $user = \Auth::user();
        $user->email = $request->get('email');
        $user->notify(new SendMail($user->token));
        $user->status = false;
        $user->save();
        return redirect()->back()->with('message','please confirm your email');
    }

    public function editPassword(Request $request)
    {
        $this->validate($request, [
            'confirmPassword' => 'required|min:6',
            'newPassword' => 'required|min:6'
        ]);
        $user = \Auth::user();
        if(Hash::check($request->get('confirmPassword'), \Auth::user()->password )) {
            $user->password = bcrypt($request->get('newPassword'));
            $user->save();
            $user->notify(new SendMessage());
        }
        return redirect()->back();
    }
}
