<?php
include '../config.php'; // Koneksi database

// Filter berdasarkan rentang tanggal jika dikirim
if (isset($_POST["filter"])) {
    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    $expense = filterExpenseByDate($start, $end); // Buat fungsi ini di config.php
} else {
    $expense = getAllExpense();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
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
        <?php include "../Layout/sidebar.php" ?>
    </div>

    <div class="container mt-5">
        <div class="text-center report-title">LAPORAN DATA PENJUALAN PRODUK</div>

        <!-- Filter dan Cetak -->
        <div class="row justify-content-between align-items-end no-print mb-4">
            <!-- Filter tanggal -->
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

            <!-- Tombol cetak -->
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
                        <th>Invoice</th>
                        <th>Pembayaran</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($expense)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-danger">Tidak ada data ditemukan</td>
                        </tr>
                    <?php else: ?>
                        <?php $i = 1; ?>
                        <?php foreach ($expense as $row): ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?= htmlspecialchars($row["invoice"]) ?></td>
                                <td>Rp <?= number_format($row["total_price"], 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($row["date_income"]) ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php
                        // Hitung total
                        $totalBayar = 0;
                        foreach ($expense as $row) {
                            $totalBayar += $row["total_price"];
                        }
                    ?>
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Total Penjualan</td>
                        <td class="fw-bold">Rp <?= number_format($totalBayar, 0, ',', '.') ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
