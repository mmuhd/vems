<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerRent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private  $emailContent = '';

    /**
     *
     * @param string $emailAddress
     * @param string $emailContent
     * @return void
     */
    public function __construct(string $emailContent)
    {
        $this->emailContent = $emailContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_NO_REPLY_ADDRESS','yhfagge@vanniatech.com'))
            ->markdown('emails.rent.customer')
            ->with([
                'emailContent' => $this->emailContent
            ]);
    }
}
