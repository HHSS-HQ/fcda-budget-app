<?php

namespace App\Jobs;

use \Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPasswordResetEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function handle()
    {
        // Your email sending logic here
        Mail::send('email.password-reset', ['token' => $this->token], function($message) {
            $message->to($this->email);
            $message->subject('OpenBudgetCT - Reset Password');
        });
    }
}
