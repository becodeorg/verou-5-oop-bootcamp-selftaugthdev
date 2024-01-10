<?php

declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$items = [
    "Bananas" => ["quantity" => 6, "price_per_unit" => 1, "tax_rate" => 0.06],
    "Apples" => ["quantity" => 3, "price_per_unit" => 1.5, "tax_rate" => 0.06],
    "Bottles of Wine" => ["quantity" => 2, "price_per_unit" => 10, "tax_rate" => 0.21]
];

$total_price = 0;
$total_tax = 0;

foreach ($items as $item) {
    $item_total = $item["quantity"] * $item["price_per_unit"];
    $total_price += $item_total;
    $total_tax += $item_total * $item["tax_rate"];
}

echo "Total Price: €" . $total_price . "\n";
echo "Total Tax: €" . $total_tax . "\n";
