<?php
namespace MiniStore\Modules\Products;

final class Product {
    private string $id;
    private string $name;
    private float $price;
    private int $stock;

    public function __construct(string $id, string $name, float $price, int $stock) {
        $this->id = $id;
        $this->setName($name);
        $this->setPrice($price);
        $this->setStock($stock);
    }

    private function setName(string $name) {
        if(empty($name)) throw new \Exception("Product name cannot be empty");
        $this->name = $name;
    }

    private function setPrice(float $price) {
        if($price <= 0) throw new \Exception("Price must be positive");
        $this->price = $price;
    }

    private function setStock(int $stock) {
        if($stock < 0) throw new \Exception("Stock cannot be negative");
        $this->stock = $stock;
    }

    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getStock(): int { return $this->stock; }

    public function reduceStock(int $qty): void {
        if($qty > $this->stock) throw new \Exception("Not enough stock for {$this->name}");
        $this->stock -= $qty;
    }
}
