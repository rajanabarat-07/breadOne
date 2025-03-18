<?php
// Menyertakan file koneksi dan navbar
include '../config.php';
include '../Layout/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_category = $_POST['name_category'];

    // Query untuk menambahkan kategori
    $category = "INSERT INTO `bo-category` VALUES ('', '$name_category')";
    $result = mysqli_query($conn, $category);

    if ($result) {
        header("Location: category-index.php?status=sukses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Tambah Kategori</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name_category" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="name_category" name="name_category"
                    placeholder="Masukkan nama kategori" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
            <a href="category-index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>