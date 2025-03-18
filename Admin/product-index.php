<?php 
    include "../config.php";

    $product = query("SELECT * FROM `bo-product`");

    if(isset($_POST["search"])){
        $product = srch($_POST["keyword"]);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bread One - Daftar Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard</h1>
        <?php include "../Layout/sidebar.html"; ?>

        <div class="d-flex justify-content-between mb-3 mt-3">
            <form action="" method="POST" class="d-flex">
                <input type="text" name="keyword" class="form-control me-2" placeholder="Cari produk..." autocomplete="off" autofocus>
                <button type="submit" name="search" class="btn btn-outline-secondary">Cari</button>
            </form>
            <a href="product-add.php" class="btn btn-primary">Tambahkan Produk</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($product as $row) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img src="../Images/<?= $row["image_product"]; ?>" alt="Gambar Roti" class="img-thumbnail" width="50"></td>
                            <td><?= $row["name_product"] ?></td>
                            <td>Rp <?= number_format($row["price_product"], 0, ',', '.') ?></td>
                            <td><?= $row["id_category"] ?></td>
                            <td>
                                <a href="product-updt.php?id=<?= $row["id_product"]; ?>" class="btn btn-warning btn-sm">Perbarui</a>
                                <a href="product-del.php?id=<?= $row["id_product"]; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                <a href="product-detail.php?id=<?= $row["id_product"]; ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>