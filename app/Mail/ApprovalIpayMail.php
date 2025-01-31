<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalIpayMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $merchantProfile;
    public $iPay;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $merchantProfile, $iPay)
    {
        $this->user = $user;
        $this->merchantProfile = $merchantProfile;
        $this->iPay = $iPay;
    }

    public function build()
    {
        return $this->subject('Persetujuan Pengajuan Dagang')
                    ->view('emails.approvalIpay')
                    ->with([
                        'user' => $this->user,
                        'iPay' => $this->iPay,
                        'merchantProfile' => $this->merchantProfile
                    ]);
    }
}
