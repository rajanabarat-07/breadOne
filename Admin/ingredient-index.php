<?php
// Menyertakan file koneksi dan navbar
include '../config.php';

// Ambil semua kategori atau berdasarkan pencarian
$search = isset($_POST["keyword"]) ? $_POST["keyword"] : '';
$ingredient = isset($_POST["search"]) ? searchIngredient($search) : getAllIngredient();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "../Layout/sidebar.php"; ?>
    <div class="container mt-5">
        <h2 class="text-left mb-4">Ingredient</h2>
        <!-- Form Pencarian dan Tambah -->
        <div class="d-flex justify-content-between mb-3 mt-3">
            <?php include "../Layout/searchbar.php"; ?>
            <div class="d-flex">
                <a href="ingredient-add.php" class="btn btn-primary me-2">Tambahkan Bahan</a>
                <a href="ingredient-import.php" class="btn btn-success">Import Bahan</a>
            </div>
            <!-- <a href="ingredient-add-stock.php" class="btn btn-success">Input Stok Bahan</a> -->
        </div>

        <!-- Tabel Bahan -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Id Bahan</th>
                            <th>Nama Bahan</th>
                            <th>Stock</th>
                            <th>Satuan</th>
                            <th class="text-center">Aksi</th>
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
                                <td>{$row['qty_ingredient']}</td>
                                <td>{$row['unit_ingredient']}</td>
                                <td class='text-center'>
                                    <a href='ingredient-updt.php?id={$row['id_ingredient']}' class='btn btn-sm btn-warning'>Perbarui</a>
                                    <a href='ingredient-del.php?id={$row['id_ingredient']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus bahan ini?\")' class='btn btn-sm btn-danger'>Hapus</a>
                                </td>
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
</body>

</html>