<?php

namespace App\Providers;

use App\Notifications\SendMail;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SendMail' => [
            'App\Listeners\EventSendMail',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('event.SendMail', function ($user) {
            $url = route('comparison', ['token' => $user->token]);
            $user->notify(new SendMail($url));
        });
    }
}
