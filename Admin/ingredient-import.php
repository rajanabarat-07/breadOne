<?php
include "../config.php";

$ingredient = query("SELECT * FROM `bo-ingredient` ORDER BY name_ingredient ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function addIngredientField() {
            let container = document.getElementById("ingredient-table-body");
            let html = `
                <tr>
                    <td>
                        <select class="form-control" name="id_ingredient[]" required>
                            <option value="">-- Pilih Bahan --</option>
                            <?php foreach ($ingredient as $row): ?>
                                <option value="<?= $row['id_ingredient']; ?>">
                                    <?= $row['name_ingredient']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="qty[]" placeholder="Jumlah" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="price[]" placeholder="Harga" required>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="this.closest('tr').remove();">Hapus</button>
                    </td>
                </tr>`;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
</head>
<body class="p-4">
    <h2 class="mb-4">Import Bahan Baku ke Inventory</h2>
    <hr>

    <form method="post" action="ingredient-import-proses.php">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Bahan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="ingredient-table-body">
                <!-- Baris input akan ditambahkan di sini -->
            </tbody>
        </table>

        <div class="mb-3">
            <button type="button" class="btn btn-success" onclick="addIngredientField()">Tambah</button>
        </div>

        <div class="d-flex justify-content-between">
            <a href="ingredient-index.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary" name="submit">Tambahkan Bahan</button>
        </div>
    </form>
</body>
</html>
