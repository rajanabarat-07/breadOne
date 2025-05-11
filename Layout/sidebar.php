<?php
session_start();

if (!isset($_SESSION['name_admin'])) {
    header("Location: index.php");
    exit();
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
                    <a class="nav-link" href="admin-dashboard.php">
                        <i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="akunDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-gear"></i> Master
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                        <li><a class="dropdown-item" href="product-index.php"></i>Product</a></li>
                        <li><a class="dropdown-item" href="category-index.php"></i>Category</a></li>
                        <li><a class="dropdown-item" href="ingredient-index.php"></i>Ingredient</a></li>
                        <li><a class="dropdown-item" href="order-index.php"></i>Order</a></li>
                        <li><a class="dropdown-item" href="cost-add.php"></i>Cost</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="akunDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-bar-chart-line"></i> Reports
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown"> 
                        <li><a class="dropdown-item" href="report-income.php"></i>Income Reports</a></li>
                        <li><a class="dropdown-item" href="report-cost.php"></i>Cost Report</a></li>
                        <li><a class="dropdown-item" href="report-profit.php"></i>Profit Reports</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="akunDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-cup-hot"></i></i> Production
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                        <li><a class="dropdown-item" href="production-index.php"></i>Production List</a></li>
                        <li><a class="dropdown-item" href="production.php"></i>Add Production</a></li>
                        <li><a class="dropdown-item" href="product-sell.php"></i>Sell Production</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="login.php" id="akunDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="akunDropdown">
                        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-in-right"></i>
                                Logout</a></li></ul>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>