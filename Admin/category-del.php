<?php
// Menyertakan file koneksi
include '../config.php';

// Mendapatkan ID kategori dari parameter URL
$id_category = $_GET['id'];

// Validasi jika ID kategori tidak ada
if (empty($id_category)) {
    echo "<script>alert('ID kategori tidak ditemukan!'); window.location.href = 'category-index.php';</script>";
    exit;
}

// Menghapus data dari database
$sql = "DELETE FROM `bo-category` WHERE id_category = '$id_category'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Kategori berhasil dihapus!'); window.location.href = 'category-index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus kategori!'); window.history.back();</script>";
}

// Menutup koneksi
$conn->close();
?>
