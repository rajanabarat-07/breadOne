<?php
include "../config.php";

$start_date = $_GET['start_date'] ?? date('Y-m-01'); // default: awal bulan ini
$end_date = $_GET['end_date'] ?? date('Y-m-d');       // default: hari ini

// Total Pesanan
$query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `bo-order` WHERE date_cart BETWEEN '$start_date' AND '$end_date'");
$data = mysqli_fetch_assoc($query);
$total_pesanan = $data['total'];

// Pesanan Diambil
$query2 = mysqli_query($conn, "SELECT COUNT(*) AS diterima FROM `bo-order` WHERE status = 'Pesanan Telah Diambil' AND date_cart BETWEEN '$start_date' AND '$end_date'");
$data2 = mysqli_fetch_assoc($query2);
$pesanan_diterima = $data2['diterima'];

// Pesanan Ditolak
$query3 = mysqli_query($conn, "SELECT COUNT(*) AS ditolak FROM `bo-order` WHERE status = 'Pesanan Ditolak' AND date_cart BETWEEN '$start_date' AND '$end_date'");
$data3 = mysqli_fetch_assoc($query3);
$pesanan_ditolak = $data3['ditolak'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
</head>

<body>
    <?php include "../Layout/sidebar.php" ?>
    <div class="container mt-5">
        <div class="content">
            <h2>Dashboard</h2>
            <form method="GET" class="row g-3 mb-4">
                <div class="col-auto">
                    <label for="start_date" class="form-label">Dari Tanggal:</label>
                    <input type="date" name="start_date" class="form-control" value="<?= $start_date ?>">
                </div>
                <div class="col-auto">
                    <label for="end_date" class="form-label">Sampai Tanggal:</label>
                    <input type="date" name="end_date" class="form-control" value="<?= $end_date ?>">
                </div>
                <div class="col-auto align-self-end">
                    <button type="submit" class="btn btn-primary">Terapkan</button>
                </div>
            </form>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Pesanan</h5>
                            <p class="card-text"><?=$total_pesanan?></p>
                            <button type="button" class="btn btn-light">Detail</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Pesanan Telah Diambil</h5>
                            <p class="card-text"><?=$pesanan_diterima?></p>
                            <button type="button" class="btn btn-light">Detail</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Pesanan Ditolak</h5>
                            <p class="card-text"><?=$pesanan_ditolak?></p>
                            <button type="button" class="btn btn-light">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>