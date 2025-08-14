<?php
namespace MiniStore\Modules\Payments;

interface PaymentGateway {
    public function pay(float $amount): bool;
}
