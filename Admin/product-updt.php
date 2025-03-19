<?php
include "../config.php";

$id_product = $_GET["id"];

// Ambil data produk berdasarkan ID
$product = query("SELECT * FROM `bo-product` WHERE id_product = $id_product")[0];

// Ambil daftar kategori
$category = query("SELECT * FROM `bo-category` ORDER BY name_category ASC");

if (isset($_POST['submit'])) {
    if (updt($_POST) > 0) {
        echo "
                <script>
                    alert('Produk berhasil diperbarui');
                    document.location.href = 'product-index.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Produk gagal diperbarui');
                    document.location.href = 'product-updt.php?id=$id_product';
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
    <title>Perbarui Produk - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Perbarui Produk</h1>
                <form action="" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
                    <input type="hidden" name="id_product" value="<?= $product["id_product"]; ?>">
                    <input type="hidden" name="old_image" value="<?= $product["image_product"]; ?>">

                    <div class="mb-3 text-center">
                        <label for="image_product" class="form-label">Gambar Produk</label><br>
                        <img src="../Images/<?= htmlspecialchars($product['image_product']); ?>" class="img-fluid rounded" width="150" alt="Gambar Produk"><br>
                        <input type="file" class="form-control mt-2" name="image_product" id="image_product">
                    </div>

                    <div class="mb-3">
                        <label for="name_product" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name_product" id="name_product" required value="<?= htmlspecialchars($product["name_product"]) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="description_product" class="form-label">Deskripsi Produk</label>
                        <input type="text" class="form-control" name="description_product" id="description_product" required value="<?= htmlspecialchars($product["description_product"]) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="price_product" class="form-label">Harga Produk</label>
                        <input type="text" class="form-control" name="price_product" id="price_product" required value="<?= htmlspecialchars($product["price_product"]) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="id_category" class="form-label">Kategori Produk</label>
                        <select class="form-control" name="id_category" id="id_category" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($category as $row) : ?>
                                <option value="<?= $row['id_category']; ?>" <?= $row['id_category'] == $product['id_category'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($row['name_category']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                        <a href="product-index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary" name="submit">Perbarui Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
