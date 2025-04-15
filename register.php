<?php
include "config.php";

if (isset($_POST["register"])) {
    if (reg($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
              </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bread One - Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            padding: 20px;
        }


        .lobster-regular {
            font-family: "Lobster", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .img-fluid-custom {
            max-height: 400px;
            object-fit: contain;
        }

        #previewImage:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }

        .main-box {
            max-width: 900px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .main-box {
                margin-top: 20px;
            }
        }
        
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="container main-box">
        <div class="row justify-content-center align-items-center">
            
            <!-- Kolom Kiri (Gambar / Ilustrasi) -->
            <div class="col-md-6 bg-white d-none d-md-block" data-aos="fade-right">
                <div class="text-center p-4">
                    <h4 class="mt-3 lobster-regular">Selamat datang di Bread One!</h4>
                    <p class="text-muted">Silakan lengkapi formulir untuk membuat akun baru.</p>
                </div>
            </div>

            <!-- Kolom Kanan (Formulir) -->
            <div class="col-md-6 bg-light p-2" data-aos="fade-left">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <h2 class="text-center lobster-regular mb-4">Registrasi</h2>
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="text-center mb-3">
                                <label for="image_customer" style="cursor: pointer;">
                                    <img id="previewImage" src="Images/default.jpg" 
                                        class="rounded-circle shadow" 
                                        style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #ccc;" 
                                        alt="Foto Profil">
                                </label>
                                <input type="file" name="image_customer" id="image_customer" 
                                    class="form-control d-none" accept="image/*">
                                <small class="d-block mt-2 text-muted">Klik gambar untuk memilih foto</small>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="name_customer" id="name_customer" class="form-control" placeholder="Nama" required>
                                <label for="name_customer">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password_customer" id="password_customer" class="form-control" placeholder="Password" required>
                                <label for="password_customer">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Konfirmasi Password" required>
                                <label for="password_confirm">Konfirmasi Password</label>
                            </div>
                            <div class="d-grid" data-aos="zoom-in">
                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                            </div>
                            <p class="text-center mt-3">
                                Sudah mempunyai akun? <a href="login.php" class="text-decoration-none fw-semibold">Login</a> sekarang.
                            </p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap & AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

    <!-- Preview Foto Bulat -->
    <script>
        const imageInput = document.getElementById('image_customer');
        const preview = document.getElementById('previewImage');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>
