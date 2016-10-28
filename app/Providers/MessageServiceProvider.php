<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\Message;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('message', function()
        {
            return new Message();
        });
    }
}
