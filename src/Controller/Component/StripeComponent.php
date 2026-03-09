<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Stripe\StripeClient;

class StripeComponent extends Component
{
    protected StripeClient $_stripe;

    public function startup(\Cake\Event\EventInterface $event): void
    {
        $apiKey = env('STRIPE_SECRET_KEY', 'sk_test_NRkVES4kuag5EwRCoVRcMqEo');
        $this->_stripe = new StripeClient($apiKey);
    }

    public function doOnetimePayment(string $token, float $amount, string $desc): \Stripe\Charge
    {
        return $this->_stripe->charges->create([
            'amount' => (int)round($amount * 100),
            'currency' => 'gbp',
            'source' => $token,
            'description' => $desc,
        ]);
    }

    public function doRecurringPayment(string $token, string $package, string $desc): \Stripe\Customer
    {
        $customer = $this->_stripe->customers->create([
            'source' => $token,
            'description' => $desc,
        ]);
        $this->_stripe->subscriptions->create([
            'customer' => $customer->id,
            'items' => [['price' => $package]],
        ]);
        return $customer;
    }

    public function doOnetimePaymentCustomer(float $amount, string $customerId, string $desc): \Stripe\Charge
    {
        return $this->_stripe->charges->create([
            'amount' => (int)round($amount * 100),
            'currency' => 'gbp',
            'customer' => $customerId,
            'description' => $desc,
        ]);
    }

    public function refundAmount(string $chargeId): \Stripe\Refund
    {
        return $this->_stripe->refunds->create(['charge' => $chargeId]);
    }

    public function createCustomer(string $email, string $description): \Stripe\Customer
    {
        return $this->_stripe->customers->create([
            'email' => $email,
            'description' => $description,
        ]);
    }

    public function retrieveCustomer(string $customerId): \Stripe\Customer
    {
        return $this->_stripe->customers->retrieve($customerId);
    }
}
