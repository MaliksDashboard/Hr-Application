<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoticeAssessmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employeeName;
    public $branch;

    public function __construct($employeeName, $branch)
    {
        $this->employeeName = $employeeName;
        $this->branch = $branch;
    }

    public function build()
    {
        return $this->subject('Employee Probation Period Assessment')
            ->view('emails.notice_assessment');
    }
}
