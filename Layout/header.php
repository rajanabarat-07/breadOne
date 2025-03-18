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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-warning bg-warning shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">Bread One</a>

                <form class="d-flex ms-auto me-3" role="search" action="" method="POST">
                    <input class="form-control me-2 " type="search" placeholder="Cari roti kesukaanmu" aria-label="Search" autofocus autocomplete="off" name="keyword">
                    <button class="btn" style="background-color: #8B4513; color: white;" type="search" name="search">Search</button>
                </form>

                <div>
                    <a href="#" class="m-3" style="text-decoration: none;">
                        <i class="bi bi-cart fs-5 text-dark"></i>
                    </a>
                    |
                    <a href="./login.php" class="btn btn-outline-dark me-3 ms-3">Masuk</a>
                    <a href="./registrasi.php" class="btn btn-dark">Daftar</a>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>