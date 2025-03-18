<?php
// Menyertakan file koneksi
include '../config.php';

// Inisialisasi variabel
$id_category = '';
$name_category = '';

// Cek apakah halaman diakses dengan metode GET untuk mengambil data kategori
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_category'])) {
    $id_category = trim($_GET['id_category']);

    // Ambil data kategori dari database
    $query = "SELECT name_category FROM `bo-category` WHERE id_category = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_category);
    $stmt->execute();
    $stmt->bind_result($name_category);
    $stmt->fetch();
    $stmt->close();
}

// Pastikan request berasal dari metode POST untuk mengupdate data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_category = isset($_POST['id_category']) ? trim($_POST['id_category']) : '';
    $name_category = isset($_POST['name_category']) ? trim($_POST['name_category']) : '';

    // Validasi input kosong
    if (empty($id_category) || empty($name_category)) {
        echo "<script>alert('Semua data wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Mengupdate data ke database dengan prepared statement
    $category = "UPDATE `bo-category` SET name_category = ? WHERE id_category = ?";
    $stmt = $conn->prepare($category);
    $stmt->bind_param("si", $name_category, $id_category);

    if ($stmt->execute()) {
        echo "<script>alert('Kategori berhasil diperbarui!'); window.location.href = 'category-index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kategori!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
</head>
<body>
    <form action="" method="POST">
        <input type="hidden" name="id_category" value="<?= htmlspecialchars($id_category); ?>">

        <label for="name_category">Nama Kategori:</label>
        <input type="text" id="name_category" name="name_category" value="<?= htmlspecialchars($name_category); ?>" required>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
