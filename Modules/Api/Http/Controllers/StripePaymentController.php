<?php

namespace Modules\Api\Http\Controllers;


use App\Transformers\ErrorResource;
use App\Transformers\SuccessResource;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Api\Contracts\Services\PaymentService;
use Modules\Api\Contracts\Services\TransactionProductService;
use Modules\Api\Contracts\Services\TransactionService;
use Stripe\Charge;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripePaymentController extends BaseController
{

    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function stripe()
    {
        return view('api::test.stripe');
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create([
            "customer" => "TuanKc",
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        return "Payment successful!";
//        Session::flash('success', 'Payment successful!');

//        return back();
    }

    public function checkout()
    {
        return view('api::test.checkout');
    }

    public function post()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 200,
                'currency' => 'jpy',
                'payment_method_types' => ['card'],
            ]);

            $output = [
                'clientId' => $paymentIntent->id,
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (\Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (ApiErrorException $e) {
            echo json_encode(['error-api' => $e->getMessage()]);
        }
    }

    public function getViewCheckout(): View
    {
        return view('api::strip.checkout');
    }

    public function postCheckout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


    }

    public function payment()
    {
        return view('api::strip.payment');
    }

    public function retrieve(string $retrieve)
    {
        $payment = $this->paymentService->getPaymentInfoByIntent($retrieve);

        return json_encode($payment);
//        return SuccessResource::make($payment);
    }
}
