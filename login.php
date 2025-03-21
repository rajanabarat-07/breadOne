<?php
include "config.php";
if (isset($_POST["login"])) {
    $name_customer = $_POST["name_customer"];
    $password_customer = $_POST["password_customer"];

    $login_customer = mysqli_query($conn, "SELECT * FROM `bo-customer` WHERE name_customer = '$name_customer'");

    // Validate name_customer
    if (mysqli_num_rows($login_customer) === 1) {
        // Validate password_customer
        $row = mysqli_fetch_assoc($login_customer);
        if (password_verify($password_customer, $row["password_customer"])) {
            header("Location: index.php");
            exit();
        }
    }
    $error = "true";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bread One - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');

        .lobster-regular {
            font-family: "Lobster", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h2 class="text-center mb-4 lobster-regular">Bread One</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            Nama dan password yang Anda masukkan salah.
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST" autocomplete="off">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name_customer" id="name_customer"
                                placeholder="Nama" autocomplete="off" required>
                            <label for="name_customer">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password_customer" id="password_customer"
                                placeholder="Password" autocomplete="new-password" required>
                            <label for="password_customer">Password</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </div><br>
                        <p>Belum mempunyai akun? <a href="registrasi.php">Registrasi</a> disini.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>