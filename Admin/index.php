<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
                    <div class="text-center mb-3">
                        <img src="admin.png" alt="" width="100">
                    </div>
                    <h2 class="text-center mb-4 lobster-regular">Admin</h2>
                    <form action="login.php" method="POST" autocomplete="off">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name_admin" id="name_admin"
                                placeholder="Nama" autocomplete="off" required>
                            <label for="name_admin">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password_admin" id="password_admin"
                                placeholder="Password" autocomplete="new-password" required>
                            <label for="password_admin">Password</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </div><br>
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