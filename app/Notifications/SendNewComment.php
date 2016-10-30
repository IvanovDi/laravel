<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendNewComment extends Notification
{
    use Queueable;

    protected $countComment;
    protected $url;
    public function __construct($countComment, $url)
    {
        $this->url = $url;
        $this->countComment = $countComment;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("your post have new $this->countComment comment")
                    ->action('Read new comment', $this->url)
                    ->line('Thank you for using our application!');
    }
}
