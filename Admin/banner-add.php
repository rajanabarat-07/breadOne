<?php
include "../config.php";

if (isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST["title_banner"]);
    $description = htmlspecialchars($_POST["description_banner"]);

    // Proses upload gambar
    $imageName = $_FILES['image_banner']['name'];
    $imageTmp = $_FILES['image_banner']['tmp_name'];
    $imagePath = "../Images/" . $imageName;

    if (move_uploaded_file($imageTmp, $imagePath)) {
        // Simpan ke database
        $query = "INSERT INTO `bo-banner` (image_banner, title_banner, description_banner) 
                  VALUES ('$imageName', '$title', '$description')";
        if (execute($query)) {
            echo "
                <script>
                    alert('Banner berhasil ditambahkan');
                    document.location.href = 'banner-index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal menambahkan banner');
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Gagal mengunggah gambar');
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Banner - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Tambah Banner</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title_banner" class="form-label">Judul Banner</label>
                            <input type="text" class="form-control" name="title_banner" id="title_banner" required>
                        </div>
                        <div class="mb-3">
                            <label for="description_banner" class="form-label">Deskripsi Banner</label>
                            <textarea class="form-control" name="description_banner" id="description_banner" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image_banner" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" name="image_banner" id="image_banner" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="banner-index.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary" name="submit">Tambah Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
