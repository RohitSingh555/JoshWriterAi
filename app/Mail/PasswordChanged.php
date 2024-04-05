<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordChanged extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Password Changed Successfully')
                    ->view('emails.password_changed');
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Password changed successfully!',
        );
    }
}
