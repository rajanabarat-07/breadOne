<?php if ($status == 'Menunggu Konfirmasi') : ?>
    <span class="badge rounded-pill text-bg-warning">Menunggu</span>
<?php elseif ($status == 'Menunggu Pembayaran') : ?>
    <span class="badge rounded-pill text-bg-danger">Menunggu Pembayaran</span>
<?php elseif ($status == 'Pesanan Sedang Diproses') : ?>
    <span class="badge rounded-pill text-bg-primary">Pesanan Sedang Diproses</span>
<?php elseif ($status == 'Pesanan Selesai') : ?>
    <span class="badge rounded-pill text-bg-success">Pesanan Selesai</span>
<?php elseif ($status == 'Pesanan Telah Diambil') : ?>
    <span class="badge rounded-pill text-bg-secondary">Pesanan Telah Diambil</span>
<?php elseif ($status == 'Pesanan Dibatalkan') : ?>
    <span class="badge rounded-pill text-bg-danger">Pesanan Dibatalkan</span>
<?php endif; ?>

<!-- Status -->
 
<!-- 1. Silahkan request jika suda Pesanan -->
<!-- 2. Menunggu Konfirmasi Pesanan -->
<!-- 3. Menunggu Pembayaran -->
<!-- 4. Pesanan Sedang Diproses -->
<!-- 5. Pesanan Selesai -->
<!-- 6. Pesanan Telah Diambil -->

<!-- accept yang mengurangi bahan bahan -->
<?php
include '../../config.php'; // Koneksi database

if (isset($_GET['inv'])) {
    $invoice = $_GET['inv'];
    $total_belanja = 0;

    // Ambil semua produk berdasarkan invoice dari tabel bo-production
    $produk_result = mysqli_query($conn, "SELECT * FROM `bo-production` WHERE invoice = '$invoice'");

    while ($produk = mysqli_fetch_assoc($produk_result)) {
        $id_product = $produk['id_product'];
        $qty_cart = $produk['qty_cart'];
        $price_cart = $produk['price_cart'];

        $subtotal = $qty_cart * $price_cart;
        $total_belanja += $subtotal;

        // Ambil bahan-bahan dari tabel bo-bom untuk produk ini
        $bom_result = mysqli_query($conn, "SELECT id_ingredient, require_ingredient FROM `bo-bom` WHERE id_product = '$id_product'");

        while ($bom = mysqli_fetch_assoc($bom_result)) {
            $id_ingredient = $bom['id_ingredient'];
            $qty_per_product = $bom['require_ingredient'];

            // Hitung total bahan yang dibutuhkan
            $total_qty_bahan = $qty_per_product * $qty_cart;

            // Kurangi stok bahan di bo-ingredient
            mysqli_query($conn, "UPDATE `bo-ingredient` SET qty_ingredient = qty_ingredient - $total_qty_bahan WHERE id_ingredient = '$id_ingredient'");
        }

        // Penambahan data ke tabel bo-income
        $get_date = mysqli_query($conn, "SELECT date_cart FROM `bo-production` WHERE invoice = '$invoice' LIMIT 1");
        $row_date = mysqli_fetch_assoc($get_date);
        $date_cart = $row_date['date_cart'];
    }

    // Setelah bahan dikurangi, ubah status menjadi "Menunggu Pembayaran"
    $query = "UPDATE `bo-production` SET `status` = 'Menunggu Pembayaran' WHERE `invoice` = '$invoice'";
    $result = mysqli_query($conn, $query);

    // Setelah di accept, tambahkan pengeluaran ke tabel bo-income 
    $query_income = "INSERT INTO `bo-income` VALUES ('$invoice', '$total_belanja', '$date_cart')";
    $result_income = mysqli_query($conn, $query_income);

    if ($result) {
        echo "<script>alert('Pesanan berhasil diterima dan stok bahan telah dikurangi!'); window.location.href='../order-index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui status.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invoice tidak ditemukan.'); window.history.back();</script>";
}
?>
