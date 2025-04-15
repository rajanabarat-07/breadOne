<?php
include "config.php";

$id_product = mysqli_real_escape_string($conn, $_GET['id']);

$query = "SELECT p.*, c.name_category 
          FROM `bo-product` p 
          JOIN `bo-category` c ON p.id_category = c.id_category 
          WHERE p.id_product = '$id_product' LIMIT 1";

$product = query($query);

if (empty($product)) {
    die("Produk tidak ditemukan.");
}

$row = $product[0]; // Ambil langsung elemen pertama


$ingredient = query("SELECT * FROM `bo-ingredient` ORDER BY name_ingredient ASC");

///Batasan



?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($row['name_product']) ?> - Bread One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .step {
            overflow-y: hidden;
        }
    </style>

</head>

<body>
    <?php include "Layout/header.php"; ?>

    <div class="container mt-5">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-md-3 text-center" data-aos="fade-right">
                <img src="Images/<?= htmlspecialchars($row['image_product']) ?>" class="img-fluid rounded shadow-sm"
                    alt="<?= htmlspecialchars($row['name_product']) ?>">
            </div>

            <!-- Detail Produk -->
            <div class="col-md-6" data-aos="fade-up">
                <h2><?= htmlspecialchars($row['name_product']) ?></h2>
                <h4 class="text-success">Rp<?= number_format($row["price_product"], 0, ',', '.') ?></h4>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($row["name_category"]) ?></p>
                <p><strong>Masa Simpan:</strong> <?= htmlspecialchars($row['life_product']) ?> hari</p>
                <p><strong>Stock:</strong> <?= htmlspecialchars($row['stock_product']) ?></p>
                <hr>

                <h4>Bahan Bahan</h4>
                <div class="table-responsive rounded shadow-sm">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Bahan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result1 = mysqli_query($conn, "SELECT i.name_ingredient, b.require_ingredient, i.unit_ingredient 
                                FROM `bo-bom` b JOIN `bo-ingredient` i ON b.id_ingredient=i.id_ingredient 
                                WHERE b.id_product = '$id_product'");
                            $no = 1;
                            while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                                <tr class="text-center">
                                    <td><?= $no; ?></td>
                                    <td><?= htmlspecialchars($row1['name_ingredient']); ?></td>
                                    <td><?= htmlspecialchars($row1['require_ingredient'] . " " . $row1['unit_ingredient']); ?></td>
                                </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>

                <h4 class="mt-4">Cara Pembuatan</h4>
                <div class="table-responsive rounded shadow-sm step">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Langkah</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result2 = mysqli_query($conn, "SELECT step_number, step_description 
                                FROM `bo-step` WHERE id_product = '$id_product'");
                            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                <tr>
                                    <td class="text-center"><?= $row2['step_number']; ?></td>
                                    <td><?= htmlspecialchars($row2['step_description']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="col-md-3" data-aos="flip-left">
                <form action="proses/add.php" method="get">
                    <input type="hidden" name="id_customer" value="<?= $id_customer; ?>">
                    <input type="hidden" name="id_product" value="<?= $id_product; ?>">
                    <input type="hidden" name="hal" value="2">
                    <input type="hidden" id="maxStock" value="<?= $row['stock_product'] ?>">

                    <div class="card shadow-sm p-3 text-center">
                        <h5 class="mb-3">Atur Jumlah</h5>

                        <!-- Input Jumlah -->
                        <div class="mb-3">
                            <div class="input-group justify-content-center">
                                <input class="form-control text-center" type="number" min="1" name="qty_cart" id="qtyInput" value="1"
                                    style="max-width: 100px;">
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <?php if (isset($_SESSION['name_customer'])) { ?>
                            <button type="submit" class="btn btn-success w-100" id="submitBtn" >
                                <i class="fas fa-shopping-cart"></i> Tambahkan ke Keranjang
                            </button>
                            <!-- Alert jika stok tidak cukup -->
                            <div id="stockAlert" class="text-danger mt-2 small d-none">
                                Stok tidak cukup
                            </div>
                        <?php } else { ?>
                            <a href="cart.php" class="btn btn-success w-100">
                                <i class="fas fa-shopping-cart"></i> Tambahkan ke Keranjang
                            </a>
                        <?php } ?>

                        <a href="product.php" class="btn btn-warning w-100 mt-2">
                            <i class="fas fa-arrow-left"></i> Kembali Belanja
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap & FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: false,
        mirror: true
    });
    </script>

    <!-- Script untuk tombol tambahkan kekeranjang -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const qtyInput = document.getElementById('qtyInput');
        const maxStock = parseInt(document.getElementById('maxStock').value);
        const submitBtn = document.getElementById('submitBtn');
        const stockAlert = document.getElementById('stockAlert');

        function validateQty() {
            const qty = parseInt(qtyInput.value);

            if (qty > maxStock) {
                submitBtn.disabled = true;
                stockAlert.classList.remove('d-none');
            } else {
                submitBtn.disabled = false;
                stockAlert.classList.add('d-none');
            }
        }

        qtyInput.addEventListener('input', validateQty);
    });
    </script>

</body>

</html>
