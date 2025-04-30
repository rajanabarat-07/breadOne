<?php
include '../config.php';

if (isset($_POST['submit'])) {
    $ids = $_POST['id_ingredient'];
    $qtys = $_POST['qty'];
    $price = $_POST['price'];

    $total = count($ids);
    $berhasil = 0;

    for ($i = 0; $i < $total; $i++) {
        $id = $ids[$i];
        $qty = floatval($qtys[$i]);
        $price = $price[$i];

        // Update jumlah stok (tambah jumlah)
        $update = mysqli_query($conn, "UPDATE `bo-ingredient` 
                                       SET qty_ingredient = qty_ingredient + $qty 
                                       WHERE id_ingredient = '$id'");
        //tampah ke history
        $history = mysqli_query($conn, "INSERT INTO `bo-ingredient-import` 
                                       VALUES ('', '$id', '$qty', CURDATE(), '$price')");
        if ($update) {
            $berhasil++;
        }
    }

    // Redirect atau tampilkan pesan
    if ($berhasil > 0) {
        echo "<script>alert('Import berhasil: $berhasil bahan ditambahkan.'); window.location='ingredient-index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.location='ingredient-index.php';</script>";
}
?>
