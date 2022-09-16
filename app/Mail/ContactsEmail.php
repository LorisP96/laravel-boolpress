<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactsEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $new_contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_lead)
    {
        $this->new_contact = $new_lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'new_contact' => $this->new_contact
        ];

        return $this->view('emails.contact-email', $data);
    }
}
