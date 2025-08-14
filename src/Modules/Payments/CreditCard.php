<?php
namespace MiniStore\Modules\Payments;

class CreditCard implements PaymentGateway {
    private string $number;

    public function __construct(string $number) {
        $this->number = $number;
    }

    public function pay(float $amount): bool {
        echo "Processing Credit Card payment of {$amount} for card {$this->number}<br>";
        return true; // محاكاة نجاح الدفع
    }
}
