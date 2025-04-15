<?php
session_start();
include "../config.php";
$admin_name = $_POST['name_admin'];
$admin_password = $_POST['password_admin'];

// Check if the form is submitted
$result = mysqli_query($conn, "SELECT * FROM `bo-admin` WHERE name_admin='$admin_name' AND password_admin='$admin_password'");
$row = mysqli_fetch_array($result);
$name_admin = $row['name_admin'];
$password_admin = $row['password_admin'];
if($admin_name == $name_admin) {
    if($admin_password == $password_admin) {
        $_SESSION['name_admin'] = $row['name_admin']; // ini yang akan dicek oleh sidebar.php
        header("Location: admin-dashboard.php");
    } else {
        echo "<script>alert('Password Salah!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Username Salah!');</script>";
    echo "<script>window.location.href='index.php';</script>";
}
?>