<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        $statusText = [
            'pending' => 'Pending Review',
            'reviewing' => 'Under Review',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'document_required' => 'Documents Required',
        ];

        $subject = 'Application Status Update - ' . ($statusText[$this->application->status] ?? 'Update');

        return $this->subject($subject)
                    ->view('emails.application-status');
    }
}