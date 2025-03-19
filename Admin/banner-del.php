<?php
include "../config.php";

// Pastikan ada ID banner yang dikirim
if (!isset($_GET["id"])) {
    echo "
        <script>
            alert('ID banner tidak ditemukan');
            document.location.href = 'banner-index.php';
        </script>
    ";
    exit;
}

$id_banner = $_GET["id"];

// Ambil data banner berdasarkan ID
$banner = query("SELECT * FROM `bo_banner` WHERE id_banner = $id_banner")[0];

// Cek apakah banner ditemukan
if (!$banner) {
    echo "
        <script>
            alert('Banner tidak ditemukan');
            document.location.href = 'banner-index.php';
        </script>
    ";
    exit;
}

// Hapus file gambar jika ada
$imagePath = "../Images/" . $banner["image_banner"];
if (file_exists($imagePath)) {
    unlink($imagePath);
}

// Hapus data banner dari database
$query = "DELETE FROM `bo_banner` WHERE id_banner = $id_banner";
if (execute($query)) {
    echo "
        <script>
            alert('Banner berhasil dihapus');
            document.location.href = 'banner-index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus banner');
            document.location.href = 'banner-index.php';
        </script>
    ";
}
?>
