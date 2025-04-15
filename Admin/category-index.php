<?php
// Menyertakan file koneksi dan navbar
include '../config.php';

// Ambil semua kategori atau berdasarkan pencarian
$search = isset($_POST["keyword"]) ? $_POST["keyword"] : '';
$categories = isset($_POST["search"]) ? searchCategories($search) : getAllCategories();
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
        <h2 class="text-left mb-4">Kategori</h2>
        <!-- Form Pencarian dan Tambah -->
        <div class="d-flex justify-content-between mb-3 mt-3">
            <?php include "../Layout/searchbar.php"; ?>
            <a href="category-add.php" class="btn btn-primary">Tambahkan Kategori</a>
        </div>

        <!-- Tabel Kategori -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Jika data ditemukan
                        if (!empty($categories)) {
                            $no = 1;
                            foreach ($categories as $row) {
                                echo "
                            <tr>
                                <td>{$no}</td>
                                <td>{$row['name_category']}</td>
                                <td class='text-center'>
                                    <a href='category-updt.php?id={$row['id_category']}' class='btn btn-sm btn-warning'>Perbarui</a>
                                    <a href='category-del.php?id={$row['id_category']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kategori ini?\")' class='btn btn-sm btn-danger'>Hapus</a>
                                </td>
                            </tr>
                            ";
                                $no++;
                            }
                        } else {
                            echo "
                        <tr>
                            <td colspan='3' class='text-center'>Tidak ada data ditemukan</td>
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