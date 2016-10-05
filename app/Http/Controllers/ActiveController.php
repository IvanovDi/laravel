<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendMail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class ActiveController extends Controller
{
    public function activate(Request $request)
    {
        $user = User::where('token', $request->query('token'))->firstOrFail();
//        dd(Carbon::now(), Carbon::parse($user->token_time)->addMinutes(1));
        if(Carbon::now() <  Carbon::parse($user->token_time)->addMinutes(1)) {
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
        $token = str_random(32);
        $user->token = $token;
        $user->token_time = Carbon::now();
        $user->save();
        $url = route('comparison', ['token' => $user->token]);
        $user->notify(new SendMail($url));
        return Redirect::back();
    }
}
