<?php
include "../config.php";

$category = query("SELECT * FROM `bo-category` ORDER BY name_category ASC");
$ingredient = query("SELECT * FROM `bo-ingredient` ORDER BY name_ingredient ASC");

// generate kode produk
$id_product = mysqli_query($conn, "SELECT id_product FROM `bo-product` ORDER BY id_product DESC LIMIT 1");
$data = mysqli_fetch_assoc($id_product);

if ($data && isset($data['id_product'])) {
    $num = substr($data['id_product'], 1, 4);
    $add = (int) $num + 1;
} else {
    $add = 1;
}

// Format ID produk
$format = "P" . str_pad($add, 4, "0", STR_PAD_LEFT);

// generate kode bom
$id_bom_query = mysqli_query($conn, "SELECT id_bom FROM `bo-bom` ORDER BY id_bom DESC LIMIT 1");
$data_bom = mysqli_fetch_assoc($id_bom_query);

if ($data_bom && isset($data_bom['id_bom'])) {
    $num_bom = substr($data_bom['id_bom'], 3);
    $add_bom = (int) $num_bom + 1;
} else {
    $add_bom = 1;
}

// Format ID BOM
$id_bom_format = "BOM" . str_pad($add_bom, 4, "0", STR_PAD_LEFT);

if (isset($_POST['submit'])) {
    if (add($_POST) > 0) {
        // Simpan data bahan ke dalam bo-bom
        $id_product = $_POST['id_product'];
        $name_product = $_POST['name_product'];

        if (!empty($_POST['id_ingredient'])) {
            foreach ($_POST['id_ingredient'] as $index => $id_ingredient) {
                $require_ingredient = $_POST['qty'][$index];
                mysqli_query($conn, "INSERT INTO `bo-bom` (id_bom, id_product, id_ingredient, name_product, require_ingredient) VALUES ('$id_bom_format', '$id_product', '$id_ingredient', '$name_product', '$require_ingredient')");
            }
        }

        if (!empty($_POST['steps'])) {
            foreach ($_POST['steps'] as $index => $step) {
                mysqli_query($conn, "INSERT INTO `bo-step` (id_product, step_number, step_description) VALUES ('$id_product', '" . ($index + 1) . "', '$step')");
            }
        }

        echo "<script>alert('Produk berhasil ditambahkan');document.location.href = 'product-index.php';</script>";
    } else {
        echo "<script>alert('Produk gagal ditambahkan');document.location.href = 'product-add.php';</script>";
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
    <script>
        function addIngredientField() {
            let container = document.getElementById("ingredient-container");
            let html = `
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select class="form-control" name="id_ingredient[]" required>
                            <option value="">-- Pilih Bahan --</option>
                            <?php foreach ($ingredient as $row): ?>
                                <option value="<?= $row['id_ingredient']; ?>">
                                    <?= $row['name_ingredient']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="qty[]" placeholder="Jumlah" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove();">Hapus</button>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addStepField() {
            let container = document.getElementById("steps-container");
            let html = `
                <div class="row mb-2">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="steps[]" placeholder="Masukkan langkah pembuatan" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove();">Hapus</button>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
</head>

<body>
    <div class="container mt-5 mb-5 p-0">
        <div class="row justify-content-center">
            <div class="col-md-15">
                <div class="card shadow-lg p-4">
                    <h2 class="text-left mb-0">Tambahkan Produk</h2>
                    <hr>
                    <form class="mb-5" action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_product" class="form-label">Id Produk</label>
                                    <input type="text" class="form-control" value="<?= $format; ?>" disabled>
                                    <input type="hidden" name="id_product" value="<?= $format; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="name_product" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="name_product" id="name_product"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="price_product" class="form-label">Harga Produk</label>
                                    <input type="text" class="form-control" name="price_product" id="price_product"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image_product" class="form-label">Gambar Produk</label>
                                    <input type="file" class="form-control" name="image_product" id="image_product"
                                        required>
                                </div>
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
                                <div class="mb-3">
                                    <label for="price_product" class="form-label">Masa Simpan Produk</label>
                                    <input type="text" class="form-control" name="life_product" id="price_product"
                                        required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <!-- From bagian bawah -->
                        <h2 class="text-left mb-4">BOM Produk</h2>
                        <hr>

                        <div class="row">
                            <div class="col">
                                <!-- Tabel Bahan -->
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

                            <!-- From input kebutuhan produk -->
                            <div class="col">
                                <div id="ingredient-container"></div>
                                <button type="button" class="btn btn-success mt-2" onclick="addIngredientField()">Tambah
                                    Bahan</button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <!-- From bagian bawah -->
                            <h2 class="text-left mb-4">Langkah Pembuatan Produk</h2>
                            <hr>

                            <div class="col">
                                <div id="steps-container"></div>
                                <button type="button" class="btn btn-success mt-2 mb-5" onclick="addStepField()">Tambah
                                    Langkah</button>
                            </div>
                            <br>
                            <br>
                            <br>
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