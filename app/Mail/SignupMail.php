<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SignupMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email, $username, $name, $password;

    public function __construct($email, $username, $name, $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->name = $name;
        $this->password = $password;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'OpenBudgetCT- New Account Registration',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.signup',
            with: ['name' => $this->name],
        );
    }

    public function build()
    {

        // return new Content(
        //     view: 'email.signup',
        //     with: ['first_name' => $this->first_name],
        // );
        return
        $this->view('email.signup')
        ->from("hello@openbudget.ct", "OpenBudgetCT")
        ->subject("OpenBudgetCT - New Account Registration");

        // -subject("Gogetit e-Naira Data Agent Portal - New Account Registration")
    }

}
