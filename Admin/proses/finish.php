<?php
include '../../config.php';
if (isset($_GET['inv'])) {
    $inv = $_GET['inv'];
    $update = mysqli_query($conn, "UPDATE `bo-order` SET status = 'Pesanan Selesai' WHERE invoice = '$inv'");
    if ($update) {
        echo "<script>alert('Pesanan ditandai selesai'); window.location='../order-index.php';</script>";
    } else {
        echo "<script>alert('Gagal memproses'); window.location='../order-index.php';</script>";
    }
}
?>
