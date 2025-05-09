<?php
include 'config.php';
session_start();

if (isset($_GET['inv'])) {
    $invoice = $_GET['inv'];

    // Update status menjadi "Pesanan Sedang Diproses"
    mysqli_query($conn, "UPDATE `bo-order` SET status = 'Pesanan Sedang Diproses' WHERE invoice = '$invoice'");

    echo "
    <script>
        alert('Terima kasih! Pembayaran kamu telah berhasil.');
        window.location.href = 'cart.php';
    </script>";
}
?>
