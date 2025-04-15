<?php
include '../config.php';

$result = mysqli_query($conn, "SELECT * FROM `bo-product`");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Stok Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "../Layout/sidebar.php"; ?>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Data Stok Produk</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success">Stok berhasil ditambahkan!</div>
                <?php endif; ?>

                <a href="tambah-stock.php" class="btn btn-success mb-3">+ Tambah Stok</a>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Stok Sekarang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['name_product'] ?></td>
                                <td><?= $row['stock_product'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
