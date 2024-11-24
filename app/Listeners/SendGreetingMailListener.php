<?php

namespace App\Listeners;

use App\Events\SendGreeingMail;
use App\Mail\GreetingMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendGreetingMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
        Mail::to($user->email)->send(new GreetingMail($user));
    }
}
