<?php
session_start();
require_once 'vendor/autoload.php';  // Memastikan autoloader Composer dimuat

include 'config.php'; // Koneksi DB

\Midtrans\Config::$serverKey = 'SB-Mid-server-5f0agzIE4Rpm3TVWp1HGSx4I';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

if (!isset($_GET['inv'])) {
    die("Invoice tidak ditemukan.");
}

$invoice = $_GET['inv'];

// Ambil data pesanan
$order_query = mysqli_query($conn, "SELECT o.*, p.name_product, p.price_product FROM `bo-order` o 
    JOIN `bo-product` p ON o.id_product = p.id_product 
    WHERE o.invoice = '$invoice'");

$items = [];
$gross_amount = 0;

while ($row = mysqli_fetch_assoc($order_query)) {
    $items[] = [
        'id' => $row['id_product'],
        'price' => (int)$row['price_product'],
        'quantity' => (int)$row['qty_cart'],
        'name' => $row['name_product']
    ];
    $gross_amount += $row['price_cart'] * $row['qty_cart'];
}

$transaction = [
    'transaction_details' => [
        'order_id' => $invoice,
        'gross_amount' => $gross_amount,
    ],
    'item_details' => $items,
    'customer_details' => [
        'first_name' => $_SESSION['name_customer'] ?? 'Customer',
    ]
];

$snapToken = \Midtrans\Snap::getSnapToken($transaction);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-26NtNHGdophHJxY4"></script>
</head>
<body>
    <script type="text/javascript">
        snap.pay("<?= $snapToken ?>", {
            onSuccess: function(result) {
                window.location.href = "success.php?inv=<?= $invoice ?>";
            },
            onPending: function(result) {
                window.location.href = "success.php?inv=<?= $invoice ?>";
            },
            onError: function(result) {
                alert("Pembayaran gagal, silakan coba lagi.");
                window.location.href = "cart.php";
            },
            onClose: function() {
                alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
                window.location.href = "cart.php";
            }
        });
    </script>
</body>
</html>
