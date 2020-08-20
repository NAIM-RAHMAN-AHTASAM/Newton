<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCoupon extends Mailable
{
    use Queueable, SerializesModels;
     private $coupon_name_To_send ="";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($coupon_name)
    {
      $this->coupon_name_To_send = $coupon_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin\mail\sendcoupon',[
          'coupon_name_To_send'=>$this->coupon_name_To_send,
        ]);
    }
}
