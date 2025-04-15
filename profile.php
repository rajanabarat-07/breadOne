<?php
session_start();
require_once "config.php";

// Cek apakah user sudah login
if (!isset($_SESSION['id_customer'])) {
    header("Location: login.php");
    exit();
}

$id_customer = $_SESSION['id_customer'];
$query = mysqli_query($conn, "SELECT * FROM `bo-customer` WHERE id_customer = '$id_customer'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .profile-avatar {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: -50px;
            border: 5px solid #fff;
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card text-center shadow" style="width: 20rem;">
        <div class="bg-gradient" style="height: 100px; background: linear-gradient(135deg, #fc726e, #fff);"></div>
        <img src="Images/<?=$data['image_customer']?>" alt="Avatar" class="profile-avatar mx-auto">
        <div class="card-body">
            <h5 class="card-title"><?= ucwords($data['name_customer'])?></h5>
            <p class="card-text text-secondary">ID : <?=$data['id_customer']?></p>
            <br>
            <div class="d-flex justify-content-center gap-2">
                <a href="index.php" class="btn btn-outline-dark btn-sm">Kembali</a>
            </div>
        </div>
    </div>

</body>

</html>

