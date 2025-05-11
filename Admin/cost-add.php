<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_cost = $_POST['name_cost']; // array
    $price_cost = $_POST['price_cost']; // array
    $qty_cost = $_POST['qty_cost']; // array
    $date_cost = $_POST['date_cost'];

    $message = "";

    foreach ($name_cost as $i => $nama) {
        $harga = $price_cost[$i];
        $jumlah = $qty_cost[$i];

        // Ambil ID terakhir setiap kali loop (atau kamu bisa simpan counter sendiri)
        $query = mysqli_query($conn, "SELECT id_cost FROM `bo-report-cost` ORDER BY id_cost DESC LIMIT 1");
        $last = mysqli_fetch_assoc($query);
        $last_id = $last ? $last['id_cost'] : null;

        $num = $last_id ? ((int) substr($last_id, 4) + 1) : 1;
        $new_id = 'COST' . str_pad($num, 4, '0', STR_PAD_LEFT);

        $insert = mysqli_query($conn, "INSERT INTO `bo-report-cost` 
            VALUES ('$new_id', '$nama', '$jumlah', '$harga', '$date_cost')");

        if (!$insert) {
            $message .= "Gagal simpan: " . mysqli_error($conn) . "<br>";
        }
    }

    if ($message === "") {
        $message = "Semua data berhasil disimpan!";
    }
}

// Ambil tanggal sekarang menggunakan PHP
$date = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Input Biaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include "../Layout/sidebar.php"; ?>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Form Input Biaya</h4>
            </div>
            <div class="card-body">
                <?php if (isset($message)): ?>
                    <div class="alert alert-info"><?= $message ?></div>
                <?php endif; ?>

                <form method="POST">
                    <!-- Nama biaya dan harga biaya dinamis -->
                    <div id="cost-container"></div>

                    <button type="button" class="btn btn-success" onclick="addCostField()">Tambah Biaya</button>

                    <input type="hidden" name="date_cost" id="date_cost" class="form-control" value="<?= $date ?>"required readonly>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>



    <script>
        // Fungsi untuk menambah form biaya dinamis
        function addCostField() {
            let container = document.getElementById("cost-container");
            let html = `
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="name_cost[]" placeholder="Nama Biaya" required>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="price_cost[]" placeholder="Harga Biaya" required>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="qty_cost[]" placeholder="Jumlah" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove();">Hapus</button>
                </div>
            </div>
        `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
</body>

</html>