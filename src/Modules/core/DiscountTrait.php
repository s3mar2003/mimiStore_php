<?php
namespace MiniStore\Modules\Core;

use MiniStore\Config;

trait DiscountTrait {
    protected function applyDiscount(float $amount): float {
        return $amount * (1 - Config::DISCOUNT_RATE);
    }
}
