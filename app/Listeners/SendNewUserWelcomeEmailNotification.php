<?php

namespace App\Listeners;

use App\Events\NewUserWelcomeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\NewUserWelcome;

class SendNewUserWelcomeEmailNotification
{
    //  implements ShouldQueue
    /**
     * Handle the event.
     *
     * @param  NewUserWelcomeEvent  $event
     * @return void
     */
    public function handle(NewUserWelcomeEvent $event)
    {
        sleep(10);
        Mail::to($event->user['email'])->send(new NewUserWelcome($event->user));
    }
}
