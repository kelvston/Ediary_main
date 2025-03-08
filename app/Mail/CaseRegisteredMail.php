<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CaseRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $case;

    public function __construct($case)
    {
        $this->case = $case;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Case Registration Successful')
            ->view('emails.case_registered')
            ->with(['case' => $this->case]);
    }
}
