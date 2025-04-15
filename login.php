<?php 
session_start();
include "config.php";

if (isset($_POST["login"])) {
    $name_customer = $_POST['name_customer'];
    $password_customer = $_POST['password_customer'];
    
    $validate = mysqli_query($conn, "SELECT * FROM `bo-customer` WHERE name_customer = '$name_customer'");
    $jml = mysqli_num_rows($validate);
    $row = mysqli_fetch_assoc($validate);
    
    if($jml ==1){
        if(password_verify($password_customer, $row['password_customer'])){
            $_SESSION['name_customer'] = $row['name_customer'];
            $_SESSION['id_customer'] = $row['id_customer'];
            header('location:index.php');
        }else{
            echo "<script>alert('USERNAME/PASSWORD SALAH'); window.location = 'login.php';</script>";
            die;
        }
    }else{
        echo "<script>alert('USERNAME/PASSWORD SALAH'); window.location = 'login.php';</script>";
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bread One - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
        body {
            height: 100vh;
            background: linear-gradient(to right, #dfe9f3, #ffffff);
        }

        .lobster-regular {
            font-family: "Lobster", sans-serif;
            font-weight: 400;
        }

        .typing-text {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-toggle-icon {
            cursor: pointer;
        }

        footer {
            margin-top: 20px;
            font-size: 0.85rem;
            color: #777;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in">
            <div class="col-md-4">
                <div class="card shadow-lg p-4 rounded-4">
                    <div class="text-center mb-3">
                        <img src="admin.png" alt="" width="100">
                    </div>
                    <h2 class="text-center mb-2 lobster-regular">Login</h2>
                    <p class="text-center typing-text" id="welcomeText"></p>

                    <form action="" method="POST" autocomplete="off">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name_customer" id="name_customer"
                                placeholder="Nama" autocomplete="off" required>
                            <label for="name_customer">Nama</label>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control" name="password_customer" id="password_customer"
                                placeholder="Password" autocomplete="new-password" required>
                            <label for="password_customer">Password</label>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3 form-toggle-icon" onclick="togglePassword()">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </div>

                        <p class="text-center">
                            Belum mempunyai akun?
                            <a href="register.php" class="text-decoration-none fw-semibold">Daftar Akun</a>
                        </p>
                    </form>

                    <footer class="text-center mt-4">
                        &copy; <?= date("Y") ?> Bread One. All rights reserved.
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        function togglePassword() {
            const input = document.getElementById("password_customer");
            const icon = document.getElementById("eyeIcon");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        // Typing effect
        const text = "Selamat datang kembali di Bread One ";
        let index = 0;
        function typeText() {
            if (index < text.length) {
                document.getElementById("welcomeText").textContent += text.charAt(index);
                index++;
                setTimeout(typeText, 40);
            }
        }
        typeText();
    </script>
</body>
</html>
