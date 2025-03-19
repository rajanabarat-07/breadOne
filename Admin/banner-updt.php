<?php
include "../config.php";

// Ambil ID banner dari URL
$id_banner = $_GET["id"];

// Ambil data banner berdasarkan ID
$banner = query("SELECT * FROM `bo-banner` WHERE id_banner = $id_banner")[0];

if (isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST["title_banner"]);
    $description = htmlspecialchars($_POST["description_banner"]);
    $old_image = $_POST["old_image"];

    // Periksa apakah ada gambar baru yang diunggah
    if ($_FILES['image_banner']['error'] === 4) {
        $imageName = $old_image; // Gunakan gambar lama jika tidak ada gambar baru
    } else {
        $imageName = $_FILES['image_banner']['name'];
        $imageTmp = $_FILES['image_banner']['tmp_name'];
        $imagePath = "../Images/" . $imageName;

        move_uploaded_file($imageTmp, $imagePath);
    }

    // Update data ke database
    $query = "UPDATE `bo-banner` 
              SET image_banner='$imageName', title_banner='$title', description_banner='$description' 
              WHERE id_banner=$id_banner";

    if (execute($query)) {
        echo "
            <script>
                alert('Banner berhasil diperbarui');
                document.location.href = 'banner-index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui banner');
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
    <title>Edit Banner - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Edit Banner</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="old_image" value="<?= $banner["image_banner"]; ?>">

                        <div class="mb-3 text-center">
                            <label class="form-label">Gambar Banner Saat Ini</label><br>
                            <img src="../Images/<?= htmlspecialchars($banner['image_banner']); ?>" 
                                class="img-fluid rounded" width="200" alt="Gambar Banner">
                        </div>

                        <div class="mb-3">
                            <label for="image_banner" class="form-label">Ganti Gambar</label>
                            <input type="file" class="form-control" name="image_banner" id="image_banner">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                        </div>

                        <div class="mb-3">
                            <label for="title_banner" class="form-label">Judul Banner</label>
                            <input type="text" class="form-control" name="title_banner" id="title_banner" required
                                value="<?= htmlspecialchars($banner["title_banner"]); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description_banner" class="form-label">Deskripsi Banner</label>
                            <textarea class="form-control" name="description_banner" id="description_banner" required><?= htmlspecialchars($banner["description_banner"]); ?></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="banner-index.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary" name="submit">Perbarui Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
