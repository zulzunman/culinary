<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalMonpayMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $merchantProfile;
    public $month;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $merchantProfile, $month)
    {
        $this->user = $user;
        $this->merchantProfile = $merchantProfile;
        $this->month = $month;
    }

    public function build()
    {
        return $this->subject('Persetujuan Pengajuan Dagang')
                    ->view('emails.approvalMonPay')
                    ->with([
                        'user' => $this->user,
                        'month' => $this->month,
                        'merchantProfile' => $this->merchantProfile
                    ]);
    }
}
