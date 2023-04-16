<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyCreateOrder extends Mailable
{
    use Queueable, SerializesModels;

    private $transaction;
    private $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaction, $products)
    {
        $this->transaction = $transaction;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $transaction = $this->transaction;
        $products = $this->products;
        return $this->subject('Order creation successful')
            ->view('api::mail-template.order.create-order-success', compact('transaction', 'products'));
    }
}
