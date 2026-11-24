<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SelamatDatangMail extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(public User $user)
    {
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat Datang di ' . config('app.name'),
        );
    }
    public function content(): Content
    {
        return new Content(
            view: 'emails.selamat_datang',
            with: [
                'user' => $this->user,
            ],
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
