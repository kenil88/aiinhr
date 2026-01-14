<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeCompanyUser;

class SendWelcomeEmail
{
    public function handle(Verified $event)
    {
        $user = $event->user;

        // Prevent duplicate welcome emails
        if ($user->welcome_email_sent) {
            return;
        }

        Mail::to($user->email)->send(
            new WelcomeCompanyUser($user)
        );

        // Optional but recommended
        $user->update([
            'welcome_email_sent' => true,
        ]);
    }
}
