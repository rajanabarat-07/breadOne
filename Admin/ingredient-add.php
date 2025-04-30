<?php
include "../config.php";

// generate kode material
$id_ingredient = mysqli_query($conn, "SELECT id_ingredient FROM `bo-ingredient` ORDER BY id_ingredient DESC LIMIT 1");
$data = mysqli_fetch_assoc($id_ingredient);

if ($data && isset($data['id_ingredient'])) {
    $num = substr($data['id_ingredient'], 1, 4);
    $add = (int) $num + 1;
} else {
    $add = 1; // Jika belum ada data, mulai dari I0001
}

// Format ID Bahan
if ($add < 10) {
    $format = "I000" . $add;
} else if ($add < 100) {
    $format = "I00" . $add;
} else if ($add < 1000) {
    $format = "I0" . $add;
} else {
    $format = "I" . $add;
}


if (isset($_POST['submit'])) {
    if (addIng($_POST) > 0) {
        echo "
                <script>
                    alert('Bahan berhasil ditambahkan');
                    document.location.href = 'ingredient-index.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Bahan gagal ditambahkan');
                    document.location.href = 'ingredient-add.php';
                </script>
            ";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bahan - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Tambahkan Bahan</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id_ingredient" class="form-label">Id Bahan</label>
                            <input type="text" class="form-control" name="id_ingredient" id="id_ingredient" value="<?= $format; ?>" disabled required>
                            <input type="hidden" class="form-control" name="id_ingredient" id="id_ingredient" value="<?= $format; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="name_ingredient" class="form-label">Nama Bahan</label>
                            <input type="text" class="form-control" name="name_ingredient" id="name_ingredient" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_ingredient" class="form-label">Satuan</label>
                            <input type="text" class="form-control" name="unit_ingredient" id="unit_ingredient" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="ingredient-index.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary" name="submit">Tambahkan Ingredient</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>