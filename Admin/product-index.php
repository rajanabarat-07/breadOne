<?php
include "../config.php";

// Ambil semua produk atau berdasarkan pencarian
$product = isset($_POST["search"]) ? searchProducts($_POST["keyword"]) : getAllProducts();
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
    <?php include "../Layout/sidebar.php"; ?>
    <div class="container mt-5">
        <h2 class="text-left mb-4">Produk</h2>
        <div class="d-flex justify-content-between mb-3 mt-3">
            <?php include "../Layout/searchbar.php"; ?>
            <a href="product-add.php" class="btn btn-primary">Tambahkan Produk</a>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($product)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data ditemukan</td>
                            </tr>
                        <?php else: ?>
                            <?php $i = 1; ?>
                            <?php foreach ($product as $row): ?>
                                <?php
                                    // Ambil stok dari bo-production
                                    $id_product = $row['id_product'];
                                    $stokQuery = mysqli_query($conn, "SELECT SUM(quantity) AS total_stock 
                                                                    FROM `bo-production` 
                                                                    WHERE id_product = '$id_product'
                                                                    AND date_expired >= CURDATE()");
                                    $stokData = mysqli_fetch_assoc($stokQuery);
                                    $total_stock = $stokData['total_stock'] ?? 0;
                                    ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><img src="../Images/<?= htmlspecialchars($row["image_product"]); ?>" alt="Gambar Roti"
                                            class="img-thumbnail" width="50"></td>
                                    <td><?= htmlspecialchars($row["name_product"]) ?></td>
                                    <td>Rp <?= number_format($row["price_product"], 0, ',', '.') ?></td>
                                    <td><?= $row["stock_product"] ?></td>
                                    <td><?= htmlspecialchars($row["name_category"]) ?></td>
                                    <td class='text-center'>
                                        <a href="product-updt.php?id=<?= $row["id_product"]; ?>"
                                            class="btn btn-sm btn-warning">Perbarui</a>
                                        <a href="product-del.php?id=<?= $row["id_product"]; ?>"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
                                            class="btn btn-sm btn-danger">Hapus</a>

                                        <?php
                                        // Ambil data BOM untuk produk ini
                                        $id_product = $row['id_product'];
                                        $bom = mysqli_query($conn, "SELECT * FROM `bo-bom` WHERE `id_product` = '$id_product'");
                                        $row2 = mysqli_fetch_assoc($bom);
                                        ?>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail<?= $row['id_product']; ?>">
                                            BOM
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalDetail<?= $row['id_product']; ?>" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bill of Material</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-hover align-middle">
                                                            <thead class="table-dark text-center">
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Bahan</th>
                                                                    <th>Jumlah</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $result1 = mysqli_query($conn, "SELECT i.name_ingredient, b.require_ingredient, i.unit_ingredient 
                                                                                                FROM `bo-bom` b JOIN `bo-ingredient` i ON b.id_ingredient=i.id_ingredient 
                                                                                                WHERE b.id_product = '$id_product'");
                                                                $no = 1;
                                                                while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                                                                    <tr class="text-center">
                                                                        <td><?= $no; ?></td>
                                                                        <td><?= htmlspecialchars($row1['name_ingredient']); ?></td>
                                                                        <td><?= htmlspecialchars($row1['require_ingredient'] . " " . $row1['unit_ingredient']); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $no++;
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>