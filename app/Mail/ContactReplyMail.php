<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    // This makes the variable available to your email template
    public $contact;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the message envelope (The Subject Line).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply to your inquiry: ' . $this->contact->subject,
        );
    }

    /**
     * Get the message content (The Email View).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_reply',
        );
    }
}