<?php

namespace App\Listeners;

use App\Services\Models\Package\PackageService;
use App\Services\Models\PurchasePackage\PurchaseService;
use App\Services\Models\User\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Stripe\Customer;
use Stripe\Event;
use Stripe\Invoice;
use Stripe\Subscription;

class StripeCustomListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Event $event)
    {
        // Determine the type of Stripe event
        $eventType = $event->type;
        info("Event Type : ".$eventType);

        // Dispatch specific methods based on the event type
        if ($eventType === 'invoice.paid') {
            $webhookHistory = $this->handleInvoicePaid($event);

            $packageService  = new PackageService();
            $purchaseService = new PurchaseService();

            // User Account Activation
            $package = $packageService->findByColumns([
                "stripe_product_id" => $webhookHistory->stripe_product_id
            ]);

            // User
            $user = (new UserService())->findByColumn(["email" ,"=", $webhookHistory->customer_email]);

            // Save Package User Data
            $packageUser = $purchaseService->savePackageUserData($user, $package);

            // Place order as Purchase Package
            $purchasePackage = $purchaseService->placePackageOrder($user, $package);

            // Package Uses
            $purchaseService->savePackageUserUsages($purchasePackage, $packageUser, $package);

            // Update User Package ID :
            $user->update([
                "package_id" => $package->id
            ]);
        } elseif ($eventType === 'customer.subscription.updated') {
            $this->handleSubscriptionUpdated($event);
        } else {
            // Handle other event types or log unrecognized events
            // ...
        }
    }

    protected function handleInvoicePaid(Event $event)
    {
        $invoiceId = $event->data['object']['id'];

        // Retrieve the invoice object from Stripe API
        $invoice = Invoice::retrieve($invoiceId);

        // Extract necessary information from the invoice
        $customerId = $invoice->customer;
        $amountPaid = $invoice->amount_paid;
        $currency   = $invoice->currency;

        // Retrieve subscription ID from the invoice
        $subscriptionId = $invoice->subscription;

        // Retrieve subscription object from Stripe API
        $subscription = Subscription::retrieve($subscriptionId);

        // Extract more details from the subscription object
        $planId         = $subscription->plan->id;
        $planAmount     = $subscription->plan->amount;
        $planCurrency   = $subscription->plan->currency;

        // Retrieve customer object from Stripe API
        $customer = Customer::retrieve($customerId);

        // Extract necessary information from the invoice
        $customerId = $invoice->customer;
        $amountPaid = $invoice->amount_paid;
        $currency   = $invoice->currency;

        // Extract customer details
        $customerName = $customer->name;
        $customerEmail = $customer->email;
        // Add more customer details as neede
    }

    protected function handleSubscriptionUpdated(Event $event)
    {
        // Logic to handle subscription updated event
        // ...
    }
}
