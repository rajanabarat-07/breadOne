<?php
include '../config.php';

$ingredients = getAllIngredient();

if (isset($_POST['submit'])) {
    $id = $_POST['id_ingredient'];
    $qty = $_POST['qty_ingredient'];
    $price = $_POST['price_ingredient'];

    // Update stok dan harga di tabel ingredient
    $query = "UPDATE ingredient 
              SET qty_ingredient = qty_ingredient + $qty, 
                  price_ingredient = $price 
              WHERE id_ingredient = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Stok berhasil ditambahkan!');
            window.location.href='ingredient.php';
        </script>";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Stok Bahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "../Layout/sidebar.php"; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Input Stok Bahan</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_ingredient" class="form-label">Pilih Bahan</label>
                <select name="id_ingredient" id="id_ingredient" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Bahan --</option>
                    <?php foreach ($ingredients as $item): ?>
                        <option value="<?= $item['id_ingredient']; ?>">
                            <?= $item['name_ingredient']; ?> (<?= $item['qty_ingredient']; ?> <?= $item['unit_ingredient']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="qty_ingredient" class="form-label">Jumlah Stok Tambahan</label>
                <input type="number" name="qty_ingredient" id="qty_ingredient" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price_ingredient" class="form-label">Harga per Satuan</label>
                <input type="number" name="price_ingredient" id="price_ingredient" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            <a href="ingredient-index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
