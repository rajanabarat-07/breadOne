<?php
include "../config.php";

$category = query("SELECT * FROM `bo-category` ORDER BY name_category ASC");

if (isset($_POST['submit'])) {
    if (add($_POST) > 0) {
        echo "
                <script>
                    alert('Produk berhasil ditambahkan');
                    document.location.href = 'product-index.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Produk gagal ditambahkan');
                    document.location.href = 'product-add.php';
                </script>
            ";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Tambahkan Produk</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="name_product" id="name_product" required>
                        </div>
                        <div class="mb-3">
                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                            <input type="text" class="form-control" name="description_product" id="description_product"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="price_product" class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" name="price_product" id="price_product" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_product" class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" name="image_product" id="image_product" required>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="id_category" class="form-label">Kategori Produk</label>
                                <select class="form-control" name="id_category" id="id_category" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($category as $row): ?>
                                        <option value="<?= htmlspecialchars($row['id_category']); ?>">
                                            <?= htmlspecialchars($row['name_category']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="product-index.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary" name="submit">Tambahkan Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>