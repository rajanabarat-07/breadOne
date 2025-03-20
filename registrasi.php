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
    <title>Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="text-center">Registrasi</h2>
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="mb-3">
                                <label for="image_customer" class="form-label">Photo Profile</label>
                                <input type="file" name="image_customer" id="image_customer" class="form-control">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="name_customer" id="name_customer" class="form-control"
                                    placeholder="Nama" autocomplete="off" required>
                                <label for="name_customer">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password_customer" id="password_customer"
                                    class="form-control" placeholder="Password" autocomplete="new-password" required>
                                <label for="password_customer">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirm" id="password_confirm"
                                    class="form-control" placeholder="Konfirmasi Password" autocomplete="new-password"
                                    required>
                                <label for="password_confirm">Konfirmasi Password</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>