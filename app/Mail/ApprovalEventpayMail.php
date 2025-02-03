<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalEventpayMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $merchantProfile;
    public $event;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $merchantProfile, $event)
    {
        $this->user = $user;
        $this->merchantProfile = $merchantProfile;
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('Persetujuan Pengajuan Dagang')
                    ->view('emails.approvaleventPay')
                    ->with([
                        'user' => $this->user,
                        'event' => $this->event,
                        'merchantProfile' => $this->merchantProfile
                    ]);
    }
}
