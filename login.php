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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h2 class="text-center mb-4">Login</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            Nama dan password yang Anda masukkan salah.
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name_customer" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name_customer" id="name_customer" autofocus autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_customer" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password_customer" id="password_customer" autofocus autocomplete="off" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>