<?php
include "../config.php";

// Ambil ID dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan');window.location.href='product-index.php';</script>";
    exit;
}

$id_product = $_GET['id'];

// Ambil data produk
$product = query("SELECT * FROM `bo-product` WHERE id_product = '$id_product'")[0];

// Ambil data kategori
$category = query("SELECT * FROM `bo-category` ORDER BY name_category ASC");

// Ambil semua bahan
$ingredient = query("SELECT * FROM `bo-ingredient` ORDER BY name_ingredient ASC");

// Ambil data BOM untuk produk ini
$bom = query("SELECT * FROM `bo-bom` WHERE id_product = '$id_product'");

// Ambil data langkah pembuatan
$steps = query("SELECT * FROM `bo-step` WHERE id_product = '$id_product' ORDER BY step_number ASC");

if (isset($_POST['submit'])) {
    $id_product = $_POST['id_product'];
    $name_product = $_POST['name_product'];
    $price_product = $_POST['price_product'];
    $id_category = $_POST['id_category'];
    $life_product = $_POST['life_product'];

    if ($_FILES['image_product']['error'] === 0) {
        $img_name = $_FILES['image_product']['name'];
        $tmp_name = $_FILES['image_product']['tmp_name'];
        move_uploaded_file($tmp_name, "../uploads/" . $img_name);
        $image_product = $img_name;
        mysqli_query($conn, "UPDATE `bo-product` SET name_product='$name_product', price_product='$price_product', id_category='$id_category', image_product='$image_product', life_product='$life_product' WHERE id_product='$id_product'");
    } else {
        mysqli_query($conn, "UPDATE `bo-product` SET name_product='$name_product', price_product='$price_product', id_category='$id_category', life_product='$life_product' WHERE id_product='$id_product'");
    }

    mysqli_query($conn, "DELETE FROM `bo-bom` WHERE id_product = '$id_product'");
    mysqli_query($conn, "DELETE FROM `bo-step` WHERE id_product = '$id_product'");

    if (!empty($_POST['id_ingredient'])) {
        foreach ($_POST['id_ingredient'] as $index => $id_ingredient) {
            $require_ingredient = $_POST['qty'][$index];
            $id_bom = "BOM" . str_pad($index + 1, 4, "0", STR_PAD_LEFT);
            mysqli_query($conn, "INSERT INTO `bo-bom` (id_bom, id_product, id_ingredient, name_product, require_ingredient) VALUES ('$id_bom', '$id_product', '$id_ingredient', '$name_product', '$require_ingredient')");
        }
    }

    if (!empty($_POST['steps'])) {
        foreach ($_POST['steps'] as $index => $step) {
            mysqli_query($conn, "INSERT INTO `bo-step` (id_product, step_number, step_description) VALUES ('$id_product', '" . ($index + 1) . "', '$step')");
        }
    }

    echo "<script>alert('Produk berhasil diperbarui');window.location.href='product-index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Produk</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">

                <div class="col">
                    <div class="mb-3">
                        <label class="form-label">ID Produk</label>
                        <input type="text" class="form-control" value="<?= $product['id_product']; ?>" disabled>
                        <input type="hidden" name="id_product" value="<?= $product['id_product']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name_product"
                            value="<?= $product['name_product']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Produk</label>
                        <input type="text" class="form-control" name="price_product"
                            value="<?= $product['price_product']; ?>" required>
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="id_category" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($category as $row): ?>
                                <option value="<?= $row['id_category']; ?>"
                                    <?= ($row['id_category'] == $product['id_category']) ? 'selected' : ''; ?>>
                                    <?= $row['name_category']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Masa Simpan (hari)</label>
                        <input type="number" class="form-control" name="life_product"
                            value="<?= $product['life_product']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Produk (kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" class="form-control" name="image_product">
                    </div>
                </div>
            </div>

            <hr>
            <h4>Bahan Produk</h4>
            <div class="row">
                <div class="col">
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Id Bahan</th>
                                        <th>Nama Bahan</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Jika data ditemukan
                                    if (!empty($ingredient)) {
                                        $no = 1;
                                        foreach ($ingredient as $row) {
                                            echo "
                                                            <tr>
                                                                <td>{$no}</td>
                                                                <td>{$row['id_ingredient']}</td>
                                                                <td>{$row['name_ingredient']}</td>
                                                                <td>{$row['unit_ingredient']}</td>
                                                            </tr>
                                                            ";
                                            $no++;
                                        }
                                    } else {
                                        echo "
                                                        <tr>
                                                            <td colspan='7' class='text-center'>Tidak ada data ditemukan</td>
                                                        </tr>
                                                        ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div id="ingredient-container">
                        <?php foreach ($bom as $item): ?>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <select class="form-control" name="id_ingredient[]">
                                        <option value="">-- Pilih Bahan --</option>
                                        <?php foreach ($ingredient as $ing): ?>
                                            <option value="<?= $ing['id_ingredient']; ?>"
                                                <?= ($ing['id_ingredient'] == $item['id_ingredient']) ? 'selected' : ''; ?>>
                                                <?= $ing['name_ingredient']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="qty[]"
                                        value="<?= $item['require_ingredient']; ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger"
                                        onclick="this.parentElement.parentElement.remove();">Hapus</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-secondary mb-4" onclick="addIngredientField()">Tambah Bahan</button>
                </div>
            </div>

            <hr>
            <h4>Langkah Pembuatan</h4>
            <div id="steps-container">
                <?php foreach ($steps as $row): ?>
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="steps[]"
                                value="<?= htmlspecialchars($row['step_description']); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger"
                                onclick="this.parentElement.parentElement.remove();">Hapus</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-secondary mb-4" onclick="addStepField()">Tambah Langkah</button>

            <div class="text-end">
                <a href="product-index.php" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        function addIngredientField() {
            const html = `
        <div class="row mb-2">
            <div class="col-md-6">
                <select class="form-control" name="id_ingredient[]">
                    <option value="">-- Pilih Bahan --</option>
                    <?php foreach ($ingredient as $ing): ?>
                        <option value="<?= $ing['id_ingredient']; ?>"><?= $ing['name_ingredient']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" name="qty[]" placeholder="Jumlah" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove();">Hapus</button>
            </div>
        </div>`;
            document.getElementById("ingredient-container").insertAdjacentHTML('beforeend', html);
        }

        function addStepField() {
            const html = `
        <div class="row mb-2">
            <div class="col-md-10">
                <input type="text" class="form-control" name="steps[]" placeholder="Masukkan langkah pembuatan" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove();">Hapus</button>
            </div>
        </div>`;
            document.getElementById("steps-container").insertAdjacentHTML('beforeend', html);
        }
    </script>
</body>

</html>S