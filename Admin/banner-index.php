<?php
include "../config.php";

// Ambil data banner dari database
$banner = query("SELECT * FROM `bo-banner`");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Banner - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kategori</h1>
        <?php include "../Layout/sidebar.html"; ?>
        <?php include "../Layout/searchbar.php";?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($banner)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada banner</td>
                        </tr>
                    <?php else: ?>
                        <?php $i = 1; ?>
                        <?php foreach ($banner as $row): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><img src="../Images/<?= htmlspecialchars($row["image_banner"]); ?>" class="img-thumbnail"
                                        width="100"></td>
                                <td><?= htmlspecialchars($row["title_banner"]) ?></td>
                                <td><?= htmlspecialchars($row["description_banner"]) ?></td>
                                <td>
                                    <a href="banner-updt.php?id=<?= $row["id_banner"]; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="banner-del.php?id=<?= $row["id_banner"]; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus banner ini?');">Hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>