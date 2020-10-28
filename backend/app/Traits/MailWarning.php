<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use App\Mail\CalendarMail;

trait MailWarning
{
    public function sendMail($email)
    {
        Mail::to($email)->send(new CalendarMail());
    }
}
