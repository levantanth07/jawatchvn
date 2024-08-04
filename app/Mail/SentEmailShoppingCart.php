<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentEmailShoppingCart extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $customer;
    public $orderDetail;
    public function __construct($order, $orderDetail, $customer)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): SentEmailShoppingCart
    {
        return $this->view('frontend.emails.create_order');
    }
}
