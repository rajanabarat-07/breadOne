<?php
include '../../config.php'; // Koneksi database

if (isset($_GET['inv'])) {
    $invoice = $_GET['inv'];
    $total_belanja = 0;

    // Ambil semua produk berdasarkan invoice dari tabel bo-order
    $produk_result = mysqli_query($conn, "SELECT * FROM `bo-order` WHERE invoice = '$invoice'");

    while ($produk = mysqli_fetch_assoc($produk_result)) {
        $id_product = $produk['id_product'];
        $qty_cart = $produk['qty_cart'];
        $price_cart = $produk['price_cart'];

        $subtotal = $qty_cart * $price_cart;
        $total_belanja += $subtotal;

        // Kurangi stok produk di tabel bo-product
        mysqli_query($conn, "UPDATE `bo-product` SET stock_product = stock_product - $qty_cart WHERE id_product = '$id_product'");

        // Ambil tanggal dari salah satu data untuk income
        $get_date = mysqli_query($conn, "SELECT date_cart FROM `bo-order` WHERE invoice = '$invoice' LIMIT 1");
        $row_date = mysqli_fetch_assoc($get_date);
        $date_cart = $row_date['date_cart'];
    }

    // Ubah status pesanan
    $query = "UPDATE `bo-order` SET `status` = 'Menunggu Pembayaran' WHERE `invoice` = '$invoice'";
    $result = mysqli_query($conn, $query);

    // Tambahkan income
    $query_income = "INSERT INTO `bo-income` VALUES ('$invoice', '$total_belanja', '$date_cart')";
    $result_income = mysqli_query($conn, $query_income);

    if ($result) {
        echo "<script>alert('Pesanan berhasil diterima dan stok produk telah dikurangi!'); window.location.href='../order-index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui status.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invoice tidak ditemukan.'); window.history.back();</script>";
}
?>
