<?php
include "config.php";

// Ambil semua banner
$banners = execute("SELECT * FROM `bo-banner`");

// Ambil semua produk
$product = execute("SELECT * FROM `bo-product`");

if (isset($_POST["search"])) {
    $product = srch($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="Layout/favicon.png" type="image/x-icon">
    <style>
        /* Mengatur rasio gambar banner */
        .carousel-item {
            position: relative;
            width: 100%;
            padding-top: 25%; /* Rasio 4:1 untuk laptop (1 / 4 * 100%) */
            overflow: hidden;
        }

        .carousel-item img {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Memastikan gambar terpotong jika melebihi rasio */
            transform: translate(-50%, -50%);
        }

        /* Rasio 16:6 untuk perangkat kecil */
        @media (max-width: 768px) {
            .carousel-item {
                padding-top: 37.5%; /* Sesuaikan untuk mobile */
            }
        }

        .text-multiline-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 2.8em;
            line-height: 1.4em;
        }

        .card:hover {
            transform: scale(1.05);
            transition: all 0.1s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <?php include "./Layout/header.php"; ?>

<!-- CAROUSEL BANNER -->
<div id="carouselExampleCaptions" class="carousel slide mb-2 mt-4 rounded-4 container px-lg-5 px-3 border border-1" 
    data-bs-ride="carousel" data-bs-interval="3000">  <!-- Slide otomatis setiap 3 detik -->

    <div class="carousel-indicators">
        <?php foreach ($banners as $index => $banner): ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $index ?>"
                class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
    </div>

    <div class="carousel-inner">
        <?php foreach ($banners as $index => $banner): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img src="Images/<?= htmlspecialchars($banner['image_banner']) ?>" class="d-block w-100"
                    alt="<?= htmlspecialchars($banner['title_banner']) ?>">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-2 rounded">
                    <h5 class="text-white"><?= htmlspecialchars($banner['title_banner']) ?></h5>
                    <p class="text-white"><?= htmlspecialchars($banner['description_banner']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    <!-- DAFTAR PRODUK -->
    <div class="container py-5 px-lg-5 px-md-4 px-3">
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            <?php foreach ($product as $row): ?>
                <div class="col">
                    <a href="product-detail.php?id=<?= $row['id_product']; ?>" class="text-decoration-none">
                        <div class="card h-100 w-100 border shadow-sm">
                            <div class="ratio ratio-1x1">
                                <img src="Images/<?= $row['image_product']; ?>" alt="Roti Fresh" class="img-fluid rounded">
                            </div>
                            <div class="card-body">
                                <p class="card-text text-muted small text-multiline-truncate"><?= $row["name_product"] ?>
                                </p>
                                <h6 class="card-title fw-bold small">Rp
                                    <?= number_format($row["price_product"], 0, ',', '.') ?>
                                </h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
