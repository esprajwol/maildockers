<?php

namespace App\Services\Stripe;

use Stripe\Customer;
use Stripe\Stripe;

class StripeService
{
    public function createStripeCustomerAccount($user)
    {

        $new_customer = Customer::create([
            'name'        => $user->fullName." .",
            'email'       => $user->email,
            'mobile_no'   => $user->mobile_no,
            'description' => env('APP_NAME').' Customer.',
        ]);

        $user->update(['stripe_id' => $new_customer->id]);

        return $new_customer;
    }


    public function getStripeCustomerById($stripe_id)
    {

        return \Stripe\Customer::retrieve(
            $stripe_id,
            []
        );
    }

    public static function ephemeralKey($customer)
    {

        return \Stripe\EphemeralKey::create(
            ['customer' => $customer->id],
            ['stripe_version' => Stripe::$apiVersion]
        );
    }


    public static function stripe_create_payment_intent(
        $customer,
        $amount,
    ) {
        $description = null;
        if (!empty($trip)) {
            $description = "Subscription payment.";
        }

        return \Stripe\PaymentIntent::create([
            'amount' => ($amount * 100),
            'currency' => env("CASHIER_CURRENCY", "usd"),
            'customer' => $customer->id,
            "description" => "Payment for subscription : {$description}"
        ]);
    }


}
