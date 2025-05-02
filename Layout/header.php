<?php
session_start();
require_once "config.php";
if (isset($_SESSION['id_customer'])) {
    $id_customer = $_SESSION['id_customer'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BreadOne</title>
    <link rel="icon" href="../Image/fav.jpg" type="image/jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .custom-nav {
            background-color: #f8f9fa;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: #ffc107 !important;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        /* Responsif untuk mobile */
        @media (max-width: 767px) {
            .navbar-brand {
                text-align: center;
                margin-bottom: 10px;
            }

            .navbar-nav {
                flex-direction: column;
                text-align: center;
            }

            .navbar-nav .nav-item {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar with offcanvas -->
    <nav class="navbar navbar-expand-lg custom-nav">
        <div class="container-fluid">
            <!-- Logo + Brand -->
            <a class="navbar-brand" href="#">
                <img src="Images/fav.jpg" alt="Logo">
            </a>

            <!-- Button to toggle the offcanvas on mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Menu -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php">
                                <i class="bi bi-box-seam"></i> Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="bi bi-receipt"></i> Orders
                                <?php
                                if (isset($_SESSION['id_customer'])) {
                                    $validate = mysqli_query($conn, "SELECT * FROM `bo-cart` WHERE id_customer = '$id_customer'");
                                    $result = mysqli_num_rows($validate);
                                    echo '<span class="badge bg-danger">' . $result . '</span>';
                                } else {
                                    echo '<span class="badge bg-secondary">0</span>';
                                }
                                ?>
                            </a>
                        </li>

                        <?php if (!isset($_SESSION['name_customer'])) { ?>
                            <li class="nav-item postiiton-static">
                                <a class="nav-link" href="login.php">
                                    <i class="bi bi-person-circle"></i> Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">
                                    <i class="bi bi-person-plus"></i> Register
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item dropdown postiiton-static">
                                <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i> <?= $_SESSION['name_customer'] ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                                    <li><a class="dropdown-item" href="profile.php"><i class="bi bi-gear"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-in-right"></i> Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Memastikan Bootstrap Bundle JS dimuat di akhir -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
