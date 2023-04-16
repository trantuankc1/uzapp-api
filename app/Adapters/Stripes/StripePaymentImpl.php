<?php

namespace App\Adapters\Stripes;

use Exception;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripePaymentImpl implements StripePayment
{
    private StripeClient $stripe;

    /**
     * StripePaymentImpl constructor.
     */
    public function __construct()
    {
        $this->stripe = $this->setApiKey();
    }

    /**
     * Set ApiKey.
     *
     * @return StripeClient
     */
    private function setApiKey(): StripeClient
    {
        return new StripeClient(env('STRIPE_SECRET'));
    }

    /**
     * Create payment intent.
     *
     * @return array
     */
    public function createPaymentIntent($transaction): array
    {
        try {
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $transaction->trans_pay_amount,
                'currency' => 'jpy',
                'payment_method_types' => ['card'],
                'metadata' => [
                    'open_id' => $transaction->open_id,
                    'trans_no' => $transaction->trans_no
                ]
            ]);

            return [
                'paymentIntentId' => $paymentIntent->id,
                'clientSecret' => $paymentIntent->client_secret,
            ];
        } catch (ApiErrorException $e) {
            \Log::error('[ERROR_CREATE_PAYMENT_INTENT] =>' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get Payment Intent.
     * @param string $retrieve
//     * @return
     */
    public function retrieve(string $retrieve)
    {
        try {
            $paymentIntent = $this->stripe->paymentIntents->retrieve($retrieve);

            $output = [
                'clientId' => $paymentIntent->id,
                'clientSecret' => $paymentIntent->client_secret,
                'status' => $paymentIntent->status,
                'transaction' => [
                    'transNo' => $paymentIntent->metadata->trans_no
                ]
            ];

            return $output;
        } catch (ApiErrorException $e) {
            \Log::error('[ERROR_CREATE_PAYMENT_INTENT] =>' . $e->getMessage());
        }
    }

    /**
     * @throws ApiErrorException
     */
    public function cancelPaymentIntent(string $paymentIntentId): PaymentIntent
    {
        return $this->stripe->paymentIntents->cancel($paymentIntentId);
    }
}
