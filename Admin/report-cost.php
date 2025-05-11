<?php
include '../config.php'; // Koneksi database

// Filter berdasarkan rentang tanggal jika dikirim
if (isset($_POST["filter"])) {
    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    $pengeluaran = filterPengeluaranByDate($start, $end); // Buat fungsi ini di config.php
} else {
    $pengeluaran = getAllPengeluaran();
    $cost = getAllCost();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th,
        .table td {
            vertical-align: middle;
            font-size: 14px;
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        @media print {
            @page {
                margin: 1.5cm;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="no-print">
        <?php include "../Layout/sidebar.php"; ?>
    </div>

    <div class="container mt-5">
        <div class="text-center report-title">LAPORAN DATA PENGELUARAN</div>

        <!-- Filter dan Cetak -->
        <div class="row justify-content-between align-items-end no-print mb-4">
            <div class="col-md-6">
                <form method="post" class="row g-2 align-items-end">
                    <div class="col">
                        <label for="start_date" class="form-label">Dari Tanggal</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="end_date" class="form-label">Sampai Tanggal</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="filter" class="btn btn-primary">Terapkan</button>
                    </div>
                </form>
            </div>

            <div class="col-md-auto text-end">
                <button type="button" onclick="window.print()" class="btn btn-secondary">Cetak</button>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-secondary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pengeluaran)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-danger">Tidak ada data ditemukan</td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-Start fw-bold" style="padding-left: 100px;">A. Import Bahan</td>
                        </tr>
                        <?php $i = 1;
                        $totalPengeluaran = 0; ?>
                        <?php foreach ($pengeluaran as $row): ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?= htmlspecialchars($row["name_ingredient"]) ?></td>
                                <td class="text-center"><?= htmlspecialchars($row["qty"]) ?></td>
                                <td>Rp <?= number_format($row["price"], 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($row["date_import"]) ?></td>
                            </tr>
                            <?php
                            $i++;
                            $totalPengeluaran += $row["price"];
                            ?>
                        <?php endforeach; ?>

                        <?php if (empty($cost)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-danger">Tidak ada data ditemukan</td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-Start fw-bold" style="padding-left: 100px;">B. Lainnya</td>
                            </tr>
                            <?php $j = 1; ?>
                            <?php foreach ($cost as $row): ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= htmlspecialchars($row["name_cost"]) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row["qty_cost"]) ?></td>
                                    <td>Rp <?= number_format($row["price_cost"], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($row["date_cost"]) ?></td>
                                </tr>
                                <?php
                                $i++;
                                $totalPengeluaran += $row["price_cost"];
                                ?>
                            <?php endforeach; ?>
                        <?php endif; ?>


                        <!-- Untuk Total Pengeluaran -->
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total Pengeluaran</td>
                            <td class="fw-bold">Rp <?= number_format($totalPengeluaran, 0, ',', '.') ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>