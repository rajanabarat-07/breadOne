<?php
// Menyertakan file koneksi dan navbar
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kategori</h1>
        <?php include "../Layout/sidebar.html"; ?>
        <!-- Form Pencarian dan Tambah -->
        <?php include "../Layout/searchbar.php";?>

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
                        // Mengambil data kategori dengan filter pencarian (jika ada)
                        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

                        if (!empty($search)) {
                            $stmt = $conn->prepare("SELECT * FROM `bo-category` WHERE name_category LIKE ? ORDER BY id_category ASC");
                            $search = "%$search%";
                            $stmt->bind_param("s", $search);
                        } else {
                            $stmt = $conn->prepare("SELECT * FROM `bo-category` ORDER BY id_category ASC");
                        }

                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Jika data ditemukan
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
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
                            <td colspan='3' class='text-center'>Tidak ada data kategori.</td>
                        </tr>
                        ";
                        }

                        $stmt->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>