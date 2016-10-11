<?php

namespace App\Http\Controllers;

use App\Traits\TokenMake;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendMail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class ActiveController extends Controller
{
    use TokenMake;
    public function activate(Request $request)
    {
        $user = User::where('token', $request->query('token'))->firstOrFail();
        if (Carbon::now() < Carbon::parse($user->token_time)->addMinutes(10)) {
            $user->status = true;
            $user->save();
        } else {
            return redirect()->route('noactive');
        }
        return redirect('/');
    }

    public function noactive()
    {
        return view('post.noactive');
    }

    public function reship()
    {
        $user = Auth::user();
        $token = $this->makeToken();
        $user->token = $token;
        $user->token_time = Carbon::now();
        $user->save();
        $user->notify(new SendMail($token));
        return Redirect::back();
    }
}
