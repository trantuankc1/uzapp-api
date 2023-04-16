<?php

namespace Modules\Api\Contracts\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;

interface PaymentService
{
    public function initPayment($transaction);

    public function getPaymentInfoByIntent(string $retrieve);

    public function paymentCancel(string $paymentIntentId);
}
