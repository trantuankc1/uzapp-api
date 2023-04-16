<?php

namespace Modules\Api\Services;

use App\Adapters\Stripes\StripePayment;
use Modules\Api\Contracts\Services\PaymentService;
use Stripe\PaymentIntent;

class PaymentServiceImpl implements PaymentService
{
    private StripePayment $stripePayment;

    public function __construct(StripePayment $stripePayment)
    {
        $this->stripePayment = $stripePayment;
    }

    public function initPayment($transaction)
    {
        return $this->stripePayment->createPaymentIntent($transaction);
    }

    public function getPaymentInfoByIntent(string $retrieve)
    {
        return $this->stripePayment->retrieve($retrieve);
    }

    public function paymentCancel(string $paymentIntentId)
    {
        return $this->stripePayment->cancelPaymentIntent($paymentIntentId);
    }
}
