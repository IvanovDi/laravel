<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notifications\SendMail;
use App\Notifications\SendMessage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'confirmPassword' => 'required|min:6',
            'newPassword' => 'required|min:6'
        ]);
    }

    public function profile()
    {
        return view('profile.profile');
    }

    public function editName(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = \Auth::user();
        $user->name = $request['name'];
        $user->save();
        return redirect()->back();
    }

    public function editEmail(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = \Auth::user();
        $url = route('comparison', ['token' => $user->token]);
        $user->notify(new SendMail($url));
        $user->email = $request['email'];
        $user->status = false;
        $user->save();
        return Redirect::back()->with('message','please confirm your email');
    }

    public function editPassword(Requests\ConfirmPasswordRequest $request)
    {
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
