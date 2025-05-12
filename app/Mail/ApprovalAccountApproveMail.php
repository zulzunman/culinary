<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalAccountApproveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $merchantProfile;
    public $product;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $merchantProfile, $product)
    {
        $this->user = $user;
        $this->merchantProfile = $merchantProfile;
        $this->product = $product;
    }

    public function build()
    {
        return $this->subject('Persetujuan Pengajuan Dagang')
                    ->view('emails.approvalAccount')
                    ->with([
                        'user' => $this->user,
                        'product' => $this->product,
                        'merchantProfile' => $this->merchantProfile
                    ]);
    }
}
