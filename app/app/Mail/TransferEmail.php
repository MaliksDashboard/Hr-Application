<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferEmail extends Mailable
{
    use SerializesModels;

    public $ccEmails;
    public $employeeName;
    public $startDate;
    public $senderEmail;
    public $transferType;
    public $pdfPath; // Store PDF path

    public function __construct($ccEmails, $employeeName, $startDate, $senderEmail, $transferType, $pdfPath)
    {
        $this->ccEmails = $ccEmails;
        $this->employeeName = $employeeName;
        $this->startDate = $startDate;
        $this->senderEmail = $senderEmail;
        $this->transferType = $transferType; 
        $this->pdfPath = $pdfPath; // Set the PDF file path
    }

    public function build()
    {
        $subject = $this->transferType === 'Rotation' ? 'Rotation Letter' : 'Transfer Letter';
        $view = $this->transferType === 'Rotation' ? 'emails.rotation' : 'emails.transfer';

        $email = $this->subject($subject)
                      ->view($view)
                      ->with([
                          'employeeName' => $this->employeeName,
                          'startDate' => $this->startDate,
                      ])
                      ->cc($this->ccEmails);

        // Attach PDF if it exists
        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $email->attach($this->pdfPath);
        }

        return $email;
    }
}
