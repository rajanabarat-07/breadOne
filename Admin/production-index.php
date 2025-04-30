<?php
include '../config.php';

// Ambil data riwayat produksi dan join dengan nama produk
$query = "
    SELECT pn.*, p.name_product 
    FROM `bo-production` pn 
    JOIN `bo-product` p ON pn.id_product = p.id_product 
    ORDER BY pn.date_production DESC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Produksi Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "../Layout/sidebar.php"; ?>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Riwayat Produksi Produk</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Diproduksi</th>
                        <th>Tanggal Produksi</th>
                        <th>Tanggal Kedaluwarsa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : 
                            // $expired = (strtotime($row['date_expired']) < strtotime(date('Y-m-d')));
                        ?>
                        <tr class="text-center <?= $expired ? 'table-danger' : '' ?>">
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['name_product']) ?></td>
                            <td><?= $row['quantity'] ?></td>
                            <td><?= date('d M Y', strtotime($row['date_production'])) ?></td>
                            <td><?= date('d M Y', strtotime($row['date_expired'])) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada riwayat produksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
