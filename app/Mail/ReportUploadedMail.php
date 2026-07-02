<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportUploadedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New CSR Project Report Uploaded | Fun Smart Foundation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.report_uploaded',
        );
    }
}
