<?php

require __DIR__ . '/../src/Autoloader.php';

use MiniStore\Modules\Products\Product;
use MiniStore\Modules\Users\Customer;
use MiniStore\Modules\Orders\Order;
use MiniStore\Modules\Payments\PayPal;


// إنشاء المنتجات
$products = [
    new Product('P1', ' labtop lenvo', 3000, 5),
    new Product('P2', 'phone', 5000, 8),
    new Product('P3', 'watch', 500, 2)
];

// إنشاء العميل
$customer = new Customer('C1', ' samar moame', 'samar@example.com');


// إنشاء الطلب
$order = new Order('ORD-001', $customer);
$order->addItem($products[0], 1);
$order->addItem($products[2], 1);
$order->addItem($products[1], 1);


// الدفع
$paymentMessage = "تم الدفع عبر paypal السعر بعد الخصم " . $order->getTotalWithDiscount() . "  " ;


?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>متجر إلكتروني</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>تفاصيل الطلب</h1>
        
        <div class="order-info">
            <h2>معلومات الطلب</h2>
            <p><strong>رقم الطلب:</strong> <?= $order->getId() ?></p>
            <p><strong>اسم العميل:</strong> <?= htmlspecialchars($customer->getName()) ?></p>
            <p><strong>حالة الطلب:</strong> <?= $order->getStatus() ?></p>
        </div>

        <div class="order-items">
            <h2>المنتجات</h2>
            <table>
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order->getItems() as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product']->getName()) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['subtotal'], 2) ?> RS</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
             </div><div class="payment-message">
    <?= $paymentMessage ?>
        </div>

       
        
   
</div>

</body>
</html>
