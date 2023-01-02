<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use  App\Mail\ResetPasswordMail;

class ResetPassword extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {


// dd(
//     (new MailMessage)
//             ->replyTo('info@remotepartner.co')
//             ->line('You are receiving this email because we received a password reset request for your account.')
//             ->action('Reset Password', url(config('app.url').route('password.reset', [$this->token, $notifiable->email], false)))
//             ->line('If you did not request a password reset, no further action is required.')
//     );

$email = $notifiable->EMAIL;

        Mail::to($email)->send(new ResetPasswordMail($email, $this->token));


        return (new MailMessage)
            ->replyTo('info@remotepartner.co')
            ->cc('pierrematos@remotepartner.co')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(config('app.url').route('password.reset2', [$this->token, $email], false)))
            ->line('If you did not request a password reset, no further action is required.');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
