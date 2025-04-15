<?php
include '../../config.php'; // Pastikan file config.php berisi koneksi ke database

if (isset($_GET['inv'])) {
    $invoice = $_GET['inv'];

    // Query untuk update status menjadi "Menunggu Pembayaran"
    $query = "UPDATE `bo-order` SET `status` = 'Pesanan Ditolak' WHERE `invoice` = '$invoice'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Pesanan berhasil ditolak dan status diperbarui!'); window.location.href='../order-index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui status.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invoice tidak ditemukan.'); window.history.back();</script>";
}
?>