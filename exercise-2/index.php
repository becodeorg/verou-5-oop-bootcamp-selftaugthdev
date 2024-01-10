<?php

declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class BasketItem {
    public string $name;
    public int $quantity;
    public float $pricePerUnit;
    public float $taxRate;
    public string $category;

    public function __construct(string $name, int $quantity, float $pricePerUnit, float $taxRate, string $category) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->pricePerUnit = $pricePerUnit;
        $this->taxRate = $taxRate;
        $this->category = $category;
    }

    public function applyDiscount(float $discountPercentage): void {
        if ($this->category === 'fruit') {
            $this->pricePerUnit *= (1 - $discountPercentage);
        }
    }    
    
    public function displayItemDetails(): string {
        return "{$this->name}: Quantity = {$this->quantity}, Total After 50% Discount = €" . $this->getTotalPrice();
    }    

    public function getTotalPrice(): float {
        return $this->quantity * $this->pricePerUnit;
    }

    public function getTaxAmount(): float {
        return $this->getTotalPrice() * $this->taxRate;
    }
}

class Basket {
    private array $items = [];

    public function addItem(BasketItem $item): void {
        $this->items[] = $item;
    }

    public function getTotalPrice(): float {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }
        return $totalPrice;
    }

    public function getTotalTax(): float {
        $totalTax = 0;
        foreach ($this->items as $item) {
            $totalTax += $item->getTaxAmount();
        }
        return $totalTax;
    }
}

$basket = new Basket();
$banana = new BasketItem("Bananas", 6, 1, 0.06, "fruit");
$apple = new BasketItem("Apples", 3, 1.5, 0.06, "fruit");
$wine = new BasketItem("Bottles of Wine", 2, 10, 0.21, "wine");

// Add a 50% discount to fruit items
$banana->applyDiscount(0.50);
$apple->applyDiscount(0.50);

$basket->addItem($banana);
$basket->addItem($apple);
$basket->addItem($wine);

// Display each item's details
echo $banana->displayItemDetails() . "<br>";
echo $apple->displayItemDetails() . "<br>";
echo $wine->displayItemDetails() . "<br>";

// Calculate and display total price and tax
echo "Total Price: €" . $basket->getTotalPrice() . "<br>";
echo "Total Tax: €" . number_format($basket->getTotalTax(), 2) . "<br>";


