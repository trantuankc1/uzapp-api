<?php

namespace App\Adapters\Stripes;

use Stripe\PaymentIntent;

interface StripePayment
{
    /**
     * Create Payment Intent.
     *
     */
    public function createPaymentIntent($transaction);

    /**
     * Get Payment Intent.
     *
     */
    public function retrieve(string $retrieve);

    public function cancelPaymentIntent(string $paymentIntentId);
}
