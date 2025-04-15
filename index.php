<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/lottie-web@5.7.4/build/player/lottie.min.js"></script>

    <style>
        body {
            overflow-x: hidden;
            background: linear-gradient(to bottom right, #fffaf0, #ffe4e1);
            /* warna pastel lembut */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }

        .bg-light {
            background-color: rgba(255, 255, 255, 0.8) !important;
            /* transparan putih */
            backdrop-filter: blur(5px);
        }

        h4 {
            margin-top: 50px;
            font-weight: bold;
            color: #8B4513;
            /* warna coklat roti */
        }
    </style>

    

</head>

<body>
    <?php include "Layout/header.php"; ?>
    <div class="container my-4">
        <div class="row">
            <div class="col text-center" data-aos="flip-up">
                <img src="Images/Component1.jpg" class="img-fluid rounded shadow" alt="Roti Fresh Breadoen">
            </div>
        </div>

        <div class="row my-4 align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <p class="p-3 bg-light rounded shadow">
                    Selamat datang di <strong>Breadone</strong>, tempat di mana setiap gigitan memberikan kebahagiaan!
                    Kami menawarkan berbagai jenis roti segar yang dibuat dengan bahan berkualitas dan tanpa pengawet.
                    Nikmati roti lembut dengan rasa yang autentik, dibuat dengan cinta untuk Anda dan keluarga.
                </p>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="Images/Component2.jpg" class="img-fluid rounded shadow" alt="Varian Roti Breadoen">
            </div>
        </div>

        <div class="row my-4 align-items-center flex-md-row-reverse">
            <div class="col-md-6" data-aos="fade-left">
                <p class="p-3 bg-light rounded shadow">
                    Kami hanya menggunakan bahan-bahan alami terbaik, seperti tepung premium, mentega asli, dan ragi
                    berkualitas tinggi. Dengan proses pembuatan yang higienis dan standar terbaik, kami memastikan
                    setiap roti yang Anda nikmati selalu segar dan lezat.
                </p>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-right">
                <img src="Images/Component3.jpg" class="img-fluid rounded shadow" alt="Bahan Berkualitas">
            </div>
        </div>

        <h4>Our Location</h4>

        <div class="row my-4 align-items-center" data-aos="zoom-in">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.507640578739!2d99.06400697363482!3d2.3342624976453736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e0581c6500fcb%3A0x80c65aac25079009!2sBread%20One!5e0!3m2!1sen!2sid!4v1743766818857!5m2!1sen!2sid"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS JS -->
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // durasi animasi dalam ms
            easing: 'ease-in-out',      // animasi hanya sekali saat masuk pertama
            once: false,
            offset: 100, // offset dari viewport
            mirror: true
        });
    </script>
</body>

</html>