<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops! Roti Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fdf6e3;
            text-align: center;
            font-family: 'Fredoka One', cursive;
        }
        .not-found-container {
            margin-top: 10vh;
        }
        .not-found-img {
            max-width: 50%;
            height: auto;
            animation: float 3s infinite ease-in-out;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .btn-custom {
            background-color: #ffad60;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 30px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom:hover {
            background-color: #ff914d;
            color: #8B4513;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="not-found-container">
        <img src="https://i.imgur.com/RD0bUjE.png" alt="Roti Hilang" class="not-found-img">
        <h1 class="text-warning mt-3">Oops! Roti Tidak Ditemukan</h1>
        <a href="index.php" class="btn btn-custom">Kembali ke Beranda</a>
        <h1 class="text-warning mt-3">🍞</h1>
    </div>
</body>
</html>
