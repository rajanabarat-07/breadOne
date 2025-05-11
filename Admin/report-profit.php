<?php
include '../config.php';

$start = '';
$end = '';

if (isset($_POST["filter"])) {
    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    $expense = filterExpenseByDate($start, $end);
    $pengeluaran = filterPengeluaranByDate($start, $end);
} else {
    $expense = getAllExpense();
    $pengeluaran = getAllPengeluaran();
    $income = getAllIncome();
    $cost = getAllCost();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuntungan</title>
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
                margin: 1cm;
            }

            .container {
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .d-print-block {
                display: block !important;
            }

            .d-none {
                display: none !important;
            }

            h2,
            h4,
            h6 {
                margin: 0;
                padding: 0;
            }

            hr {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    <div class="text-center mt-5 mb-4 d-none d-print-block">
        <h2 class="mb-0">Toko Roti Bread One</h2>
        <h4 class="mb-0">Laporan Laba Rugi</h4>
        <h6>Bulan <?= date('F', strtotime($start ?: date('Y-m-01'))) ?> Tahun
            <?= date('Y', strtotime($start ?: date('Y-m-01'))) ?>
        </h6>
        <hr>
    </div>

    <div class="no-print">
        <?php include "../Layout/sidebar.php"; ?>
    </div>

    <div class="container mt-5">
        <div class="text-center report-title no-print">LAPORAN KEUNTUNGAN</div>

        <!-- Filter dan Cetak -->
        <div class="row justify-content-between align-items-end no-print mb-4">
            <div class="col-md-6">
                <form method="post" class="row g-2 align-items-end">
                    <div class="col">
                        <label for="start_date" class="form-label">Dari Tanggal</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $start ?>"
                            required>
                    </div>
                    <div class="col">
                        <label for="end_date" class="form-label">Sampai Tanggal</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $end ?>"
                            required>
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

        <!-- Tabel Keuntungan -->
        <h4 class="no-print">Rekapitulasi</h4><br>
        <?php
        $totalKeseluruhan = 0;
            foreach ($expense as $row) {
                $totalKeseluruhan += $row["total_price"];
            }
            foreach ($income as $row2) {
                $totalKeseluruhan += $row2["total"];
            }

        $totalPengeluaran = 0;
        foreach ($pengeluaran as $p) {
            $totalPengeluaran += $p["price"];
        }
        foreach ($cost as $c) {
            $totalPengeluaran += $c["price_cost"];
        }

        $keuntungan = $totalKeseluruhan - $totalPengeluaran;
        ?>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>No.</th>
                        <th>Pendapatan</th>
                        <th>Harga Pendapatan</th>
                        <th>Pengeluaran</th>
                        <th>Harga Pengeluaran</th>
                        <th>Keuntungan Bersih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td>Penjualan Produk</td>
                        <td>Rp <?= number_format($totalKeseluruhan, 0, ',', '.') ?></td>
                        <td>Pembelian Bahan</td>
                        <td>Rp <?= number_format($totalPengeluaran, 0, ',', '.') ?></td>
                        <td class="fw-bold <?= $keuntungan >= 0 ? 'text-success' : 'text-danger' ?>">
                            Rp <?= number_format($keuntungan, 0, ',', '.') ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>