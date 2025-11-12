<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendUserRegistrationNotification;

class SendUserRegisterNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(UserRegister $event): void
    {
        Mail::to($event->user->email)->send(new SendUserRegistrationNotification($event->user,$event->token));

    }
}
