<?php
include "config.php";
$product = query("SELECT * FROM `bo-product`");

if (isset($_POST["search"])) {
    $product = srch($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="Layout/favicon.png" type="image/x-icon">
    <style>
        .text-multiline-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Batasi maksimal 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 2.8em;
            /* Sesuaikan tinggi agar cukup untuk 2 baris */
            line-height: 1.4em;
            /* Sesuaikan tinggi setiap baris */
        }

        .card:hover {
            transform: scale(1.10);
            transition: all 0.1s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <?php include "./Layout/header.php"; ?>

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