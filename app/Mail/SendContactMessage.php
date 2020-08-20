<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $name = "";
    public $email = "";
    public $subject = "";
    public $contact_message = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$subject,$message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->contact_message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.sendcontactmessage',[
          'name' => $this->name,
          'email' => $this->email,
          'subject' => $this->subject,
          'contact_message' => $this->contact_message,
        ]);
    }
}
