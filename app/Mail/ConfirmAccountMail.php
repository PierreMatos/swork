<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $email;
    public $name;

    public function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['email'] = $this->email;
        $user['name'] = $this->name;

        // dd($user);
        return $this->from("yoursenderemail@mail.com", "Sender Name")
        ->subject('Confirmar e-mail')
        ->view('mails.confirm-account', ['user' => $user]);
    }
}