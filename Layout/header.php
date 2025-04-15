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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .custom-nav {
            background-color: #f8f9fa;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: #ffc107 !important;
        }
    </style>
</head>

<body>
    <nav class="custom-nav">
        <div class="container">
            <ul class="nav nav-pills justify-content-left">
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
                            $id_customer = $_SESSION['id_customer'];
                            $validate = mysqli_query($conn, "SELECT * FROM `bo-cart` WHERE id_customer = '$id_customer'");
                            $result = mysqli_num_rows($validate);
                            ?>
                            <span class="badge bg-danger"><?= $result ?></span>
                        </a>
                </li>

                    <?php
                        } else {
                            echo "
						<span class='badge bg-secondary'>0</span>
                        </a>
                </li>

						";
                        }

                        if (!isset($_SESSION['name_customer'])) {
                            ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="login.php" id="akunDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> Akun
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                            <li><a class="dropdown-item" href="login.php"><i class="bi bi-box-arrow-in-right"></i>
                                    Login</a></li>
                            <li><a class="dropdown-item" href="register.php"><i class="bi bi-person-plus"></i> Register</a>
                            </li>
                        </ul>
                    </li>

                    <?php
                        } else {
                            ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="login.php" id="akunDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= $_SESSION['name_customer'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-in-right"></i> Logout</a></li>
                            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-gear"></i>Profile</a></li>
                        </ul>
                    </li>
                </ul>
                </li>
            <?php }
                        ; ?>
            </ul>

        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>