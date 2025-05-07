<?php

include "config.php";
// Ambil semua produk
$product = execute("SELECT * FROM `bo-product`");

if (isset($_POST["search"])) {
    $product = srch($_POST["keyword"]);

    // Jika hasil pencarian kosong, arahkan ke halaman lain
    if (empty($product)) {
        header("Location: index-not-found.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
    body {
        background-color: #fdf6e3 !important;
        text-align: center;
        font-family: 'Fredoka One', cursive;
        overflow-x: hidden;
    }

    .text-multiline-truncate {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 2.8em;
        line-height: 1.4em;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
    }
</style>

</head>

<body>
    <?php include "Layout/header.php"; ?>
    <!-- Search bar (Responsif untuk semua layar) -->
    <div class="container mt-3">
        <form class="d-flex w-100 mx-auto search-bar" role="search" action="" method="POST" data-aos="fade-left">
            <input class="form-control me-2" type="search" placeholder="Cari roti kesukaanmu..." aria-label="Search"
                name="keyword">
            <button class="btn btn-custom" type="submit" name="search">Cari</button>
        </form>
        <h1 data-aos="fade-left">Daftar Produk Kami</h1>
    </div>

    <!-- DAFTAR PRODUK -->
    <div class="container py-5 px-lg-5 px-md-4 px-3">
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            <?php 
            $aos_animations = ['fade-up', 'fade-down'];
            $i = 0;
            foreach ($product as $row): 
                $animation = $aos_animations[$i % count($aos_animations)];
                $i++;
            ?>
            <div class="col" data-aos="<?= $animation ?>">
                    <a href="product-detail.php?id=<?= $row['id_product']; ?>" class="text-decoration-none">
                        <div class="card h-100 w-100 border shadow-sm">
                            <div class="ratio ratio-1x1">
                                <img src="Images/<?= $row['image_product']; ?>" alt="Roti Fresh" class="img-fluid rounded">
                            </div>
                            <div class="card-body">
                                <p class="card-text text-muted small text-multiline-truncate mb-1"><?= $row["name_product"] ?>
                                <p class="card-text text small text-multiline-truncate mb-1"><Strong>Stock</Strong> <?= $row["stock_product"] ?>
                                </p>
                                <h6 class="card-title fw-bold small mt-1">Rp
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
    <!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        offset: 100,
        once: false,
        mirror: true,
        easing: 'ease-in-out'
    });
</script>

</body>

</html>