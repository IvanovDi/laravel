<?php

namespace App\Traits;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

trait RegisterUserExtend
{
    use RegistersUsers;

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        Event::fire('event.SendMail', array($user));

        return redirect($this->redirectPath());
    }

}