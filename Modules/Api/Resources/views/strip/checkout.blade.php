<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/stripe/v3/checkout.css') }}" />
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('assets/stripe/v3/checkout.js') }}" defer></script>
</head>
<body>
<!-- Display a payment form -->
<form id="payment-form">
    <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
    </div>
    <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span>
    </button>
    <div id="payment-message" class="hidden"></div>
</form>
</body>
</html>