<?php
include '../config.php';

if (!isset($_GET['inv'])) {
    echo "Invoice tidak ditemukan.";
    exit;
}

$invoice = $_GET['inv'];

$query = mysqli_query($conn, "SELECT pn.invoice, pn.id_customer, p.name_product, pn.qty_cart, pn.price_cart, pn.date_cart 
FROM `bo-order` pn 
JOIN `bo-product` p ON pn.id_product = p.id_product 
WHERE pn.invoice = '$invoice'");

if (mysqli_num_rows($query) == 0) {
    echo "Data pesanan tidak ditemukan.";
    exit;
}

$total = 0;
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
    $total += $row['qty_cart'] * $row['price_cart'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            color: #000;
            padding-top: 20px;
        }

        .struk {
            width: 280px;
            margin: auto;
            border-left: 1px dashed #000;
            border-right: 1px dashed #000;
            padding: 10px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        @media print {
            button {
                display: none;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>
<div class="struk">
    <div class="center">
        <strong>BreadOne</strong><br>
        <br>
        Jl. Pardolok Tolong, Napitupulu Bagasan, Kec. Balige, Toba, Sumatera Utara<br>
    </div>
    <hr>
    ID Order: <?= htmlspecialchars($invoice); ?><br>
    ID Cust : <?= htmlspecialchars($data[0]['id_customer']); ?><br>
    Tanggal : <?= htmlspecialchars($data[0]['date_cart']); ?><br>
    <hr>

    <?php foreach ($data as $item): ?>
        <?= $item['name_product']; ?><br>
        <?= $item['qty_cart']; ?> x Rp<?= number_format($item['price_cart'], 0, ',', '.'); ?>
        <div class="right">
            Rp<?= number_format($item['qty_cart'] * $item['price_cart'], 0, ',', '.'); ?>
        </div>
    <?php endforeach; ?>
    <hr>
    <strong>Total :</strong>
    <div class="right">
        <strong>Rp<?= number_format($total, 0, ',', '.'); ?></strong>
    </div>
    <hr>
    <div class="center">
        Terima kasih telah berbelanja!<br>
        - Bread One Bakery -
    </div>
</div>
<br>
<div class="center mt-3">
    <button onclick="window.print()">Cetak Struk</button>
</div>
</body>
</html>
