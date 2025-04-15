<?php
include "../config.php";

$id_ingredient = $_GET["id"];

// Ambil data produk berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM `bo-ingredient` WHERE id_ingredient = ?");
$stmt->bind_param("s", $id_ingredient); // Gunakan "s" jika id_ingredient adalah string, atau "i" jika integer
$stmt->execute();
$result = $stmt->get_result();
$ingredient = $result->fetch_assoc(); // Langsung ambil data tanpa perlu indeks [0]

if (!$ingredient) {
    echo "Bahan tidak ditemukan!";
}

if (isset($_POST['submit'])) {
    if (updtIng($_POST) > 0) {
        echo "
                <script>
                    alert('Bahan berhasil diperbarui');
                    document.location.href = 'ingredient-index.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Bahan gagal diperbarui');
                    document.location.href = 'ingredient-updt.php?id=$id_ingredient';
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
    <title>Perbarui Bahan - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Perbarui Bahan</h1>
                <form action="" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
                    <input type="hidden" name="old_id" value="<?= $ingredient["id_ingredient"]; ?>">

                    <div class="mb-3">
                        <label for="id_ingredient" class="form-label">Id Bahan</label>
                        <input type="text" class="from-control" name="id_ingredient" id="id_ingredient" value="<?= $ingredient["id_ingredient"]; ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="name_ingredient" class="form-label">Nama Bahan</label>
                        <input type="text" class="form-control" name="name_ingredient" id="name_ingredient" required value="<?= htmlspecialchars($ingredient["name_ingredient"]) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="qty_ingredient" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" name="qty_ingredient" id="qty_ingredient" required value="<?= htmlspecialchars($ingredient["qty_ingredient"]) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="unit_ingredient" class="form-label">Satuan</label>
                        <input type="text" class="form-control" name="unit_ingredient" id="unit_ingredient" required value="<?= htmlspecialchars($ingredient["unit_ingredient"]) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="price_ingredient" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="price_ingredient" id="price_ingredient" required value="<?= htmlspecialchars($ingredient["price_ingredient"]) ?>">
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                        <a href="ingredient-index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary" name="submit">Perbarui Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>