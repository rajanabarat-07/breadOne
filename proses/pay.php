<?php
include '../config.php'; // koneksi database
session_start();

// Cek apakah invoice ada di URL
if (isset($_GET['inv'])) {
    $invoice = $_GET['inv'];

    // Cek apakah pesanan dengan invoice ini statusnya 'Menunggu Pembayaran'
    $cek = mysqli_query($conn, "SELECT * FROM `bo-order` WHERE invoice = '$invoice' LIMIT 1");
    $data = mysqli_fetch_assoc($cek);

    if ($data && $data['status'] === 'Menunggu Pembayaran') {
        // Update status ke 'Menunggu Konfirmasi Admin'
        $update = mysqli_query($conn, "UPDATE `bo-order` SET status = 'Pesanan Sedang Diproses' WHERE invoice = '$invoice'");
        
        if ($update) {
            echo "
            <script>
                alert('Pembayaran berhasil! Menunggu konfirmasi admin.');
                window.location.href = '../cart.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Gagal memproses pembayaran.');
                window.location.href = '../cart.php';
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Data tidak ditemukan atau sudah dibayar.');
            window.location.href = '../cart.php';
        </script>";
    }
} else {
    echo "
    <script>
        alert('Invoice tidak ditemukan.');
        window.location.href = '../cart.php';
    </script>";
}
?>
