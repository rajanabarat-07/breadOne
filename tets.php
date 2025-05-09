<?php
require_once 'vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-5f0agzIE4Rpm3TVWp1HGSx4I';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => 10000,
    ),
    'customer_details' => array(
        'first_name' => "Ester",
        'email' => "ester@example.com",
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
echo "Snap Token: " . $snapToken;
