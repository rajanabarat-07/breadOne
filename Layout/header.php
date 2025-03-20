<?php 
    require_once __DIR__ . "/../config.php";

    $product = query("SELECT * FROM `bo-product`");

    if(isset($_POST["search"])){
        $product = srch($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BreadOne</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Navbar styling */
        .navbar-custom {
            background-color: #ffc107; /* Warna khas Tokopedia */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .search-bar {
            width: 100%;
            max-width: 500px;
        }

        /* Style tombol */
        .btn-custom {
            background-color: #8B4513;
            color: white;
            border-radius: 8px;
        }

        .btn-custom:hover {
            background-color: #6b3310;
            color: white;
        }

        /* Mengatur posisi elemen di navbar */
        .navbar-nav {
            align-items: center;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .search-bar {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand text-dark" href="#">Bread One</a>

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Search bar (Desktop) -->
                    <form class="d-none d-lg-flex mx-auto w-50 search-bar" role="search" action="" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Cari roti kesukaanmu..."
                            aria-label="Search" name="keyword">
                        <button class="btn btn-custom" type="submit" name="search">Cari</button>
                    </form>

                    <!-- Menu Kanan -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-dark">
                                <i class="bi bi-cart fs-5"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./login.php" class="btn btn-outline-dark ms-2">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="./registrasi.php" class="btn btn-dark ms-2">Daftar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Search bar (Mobile) -->
        <div class="container d-lg-none mt-3">
            <form class="d-flex search-bar" role="search" action="" method="POST">
                <input class="form-control me-2" type="search" placeholder="Cari roti kesukaanmu..." aria-label="Search"
                    name="keyword">
                <button class="btn btn-custom" type="submit" name="search">Cari</button>
            </form>
        </div>
    </header>
</body>

</html>
