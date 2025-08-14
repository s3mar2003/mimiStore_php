<?php
namespace MiniStore\Modules\Orders;

use MiniStore\Modules\Core\LoggerTrait;
use MiniStore\Modules\Core\DiscountTrait;
use MiniStore\Modules\Core\StatusTrait;
use MiniStore\Modules\Users\Customer;
use MiniStore\Modules\Products\Product;

class Order {
    use LoggerTrait, DiscountTrait, StatusTrait;

    private string $id;
    private Customer $customer;
    private array $items = [];
    private float $total = 0.0;

    public function __construct(string $id, Customer $customer) {
        $this->id = $id;
        $this->customer = $customer;
        $this->log("Order {$this->id} created for customer {$customer->getName()}");
    }

    public function addItem(Product $product, int $qty): void {
        $product->reduceStock($qty);
        $subtotal = $product->getPrice() * $qty;
        $this->items[] = ['product' => $product, 'quantity' => $qty, 'subtotal' => $subtotal];
        $this->total += $subtotal;
        $this->log("Added {$qty}x {$product->getName()} to order {$this->id}");
    }

    public function getItems(): array { return $this->items; }
    public function getTotal(): float { return $this->total; }
    public function getTotalWithDiscount(): float { return $this->applyDiscount($this->total); }
    public function getId(): string { return $this->id; }

    public function processPayment($payment): bool {
        $amount = $this->getTotalWithDiscount();
        $result = $payment->pay($amount);
        if($result) {
            $this->setStatus('paid');
            $this->log("Payment of {$amount} processed for order {$this->id}");
        } else {
            $this->log("Payment failed for order {$this->id}");
        }
        return $result;
    }
}
