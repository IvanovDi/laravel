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
        $user->name = $request['name'];
        $user->save();
        return redirect()->back();
    }

    public function editEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users'
        ]);
        $this->validator($request->all())->validate();
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
        $this->validate($request, [
            'confirmPassword' => 'required|min:6',
            'newPassword' => 'required|min:6'
        ]);
        $this->validator($request->all())->validate();
        $user = \Auth::user();
        if(Hash::check($request['confirmPassword'], \Auth::user()->password )) {
            $user->password = bcrypt($request['newPassword']);
            $user->save();
            $user->notify(new SendMessage());
        }
        return redirect()->back();
    }
}
