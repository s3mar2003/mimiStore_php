<?php
namespace MiniStore\Modules\Payments;

use MiniStore\Modules\Core\LoggerTrait;

class PayPal implements PaymentGateway {
    private string $email;
    use LoggerTrait;

    public function __construct(string $email) {
        $this->email = $email;
    }

    public function pay(float $amount): bool {
        $this->log("Processing PayPal payment of {$amount} for {$this->email}");
        // لا نطبع شيء، فقط نرجع true لمحاكاة نجاح الدفع
        return true;
    }
}
