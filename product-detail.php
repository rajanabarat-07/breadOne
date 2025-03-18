<?php
include "config.php";

// Cek apakah ada parameter ID di URL
if (!isset($_GET['id'])) {
    echo "Produk tidak ditemukan!";
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$product = query("SELECT * FROM `bo-product` WHERE id_product = $id");

// Cek apakah produk ditemukan
if (!$product) {
    echo "Produk tidak ditemukan!";
    exit;
}

// Ambil data produk
$row = $product[0];

// Menentukan jumlah produk (default 1, atau dari POST)
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

// Pastikan jumlah minimal 1 (tidak bisa 0 atau negatif)
if ($quantity < 1)
    $quantity = 1;

$subtotal = $row["price_product"] * $quantity;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?= $row["name_product"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "Layout/header.php" ?>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-3">
                <img src="Images/<?= $row['image_product']; ?>" alt="<?= $row["name_product"] ?>"
                    class="img-fluid rounded border border-secondary-subtle">
            </div>
            <div class="col-md-3 w-50">
                <h2><?= $row["name_product"] ?></h2>
                <h4 class="text-danger">Rp <?= number_format($row["price_product"], 0, ',', '.') ?></h4>
                <p><?= $row["description_product"] ?></p>
            </div>
            <div class="col card border rounded p-3 shadow-sm" style="max-width: 320px;">
                <h6 class="fw-bold">Atur jumlah dan catatan</h6>

                <!-- Form untuk menangani perubahan jumlah -->
                <form action="" method="POST">
                    <div class="d-flex align-items-center mb-2">
                        <button type="submit" name="quantity" value="<?= max(1, $quantity - 1) ?>"
                            class="btn btn-outline-secondary btn-sm">−</button>
                        <input type="text" name="quantity" class="form-control text-center mx-2"
                            value="<?= $quantity ?>" min="1" style="width: 60px;">

                        <button type="submit" name="quantity" value="<?= min(8, $quantity + 1) ?>"
                            class="btn btn-outline-success btn-sm">+</button>
                    </div>
                </form>

                <!-- Subtotal Harga -->
                <p class="text-muted small m-0">Subtotal</p>
                <h5 class="fw-bold">Rp <?= number_format($subtotal, 0, ',', '.') ?></h5>

                <!-- Tombol Keranjang dan Beli -->
                <form action="cart.php" method="POST">
                    <input type="hidden" name="id_product" value="<?= $id ?>">
                    <input type="hidden" name="total_price" value="<?= $subtotal ?>">
                    <input type="hidden" name="quantity" value="<?= $quantity ?>">
                    <button type="submit" class="btn btn-success w-100 mb-2">+ Keranjang</button>
                </form>
                <button class="btn btn-outline-success w-100">Beli</button>

                <!-- Ikon Chat, Wishlist, Share -->
                <div class="d-flex justify-content-between mt-3 text-muted small">
                    <span>💬 Chat</span> |
                    <span>❤️ Wishlist</span> |
                    <span>🔗 Share</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>