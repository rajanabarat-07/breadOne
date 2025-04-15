<?php
include '../config.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>

<body>
    <?php include "../Layout/sidebar.php" ?>
    <!-- Ganti bagian tabel dari file kamu seperti ini -->
    <div class="p-4">
        <div class="card shadow-lg p-4 mb-3">
            <h3 class="text-center mb-4">Pesanan Customer</h3>
            <div class="table-responsive">
                <table class="table table-borderless align-midlle text-left">
                    <?php
                    $cek = mysqli_query($conn, "SELECT * FROM `bo-order`");
                    $jml = mysqli_num_rows($cek);

                    if ($jml > 0) {
                        ?>
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Invoice</th>
                                <th>Id Customer</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $result2 = mysqli_query($conn, "SELECT pn.id_order, pn.invoice, pn.id_customer, p.id_product, p.name_product, pn.qty_cart, pn.price_cart, pn.status, pn.date_cart FROM `bo-order` pn JOIN `bo-product` p ON pn.id_product = p.id_product GROUP BY pn.invoice ORDER BY pn.date_cart ASC");
                            $no2 = 1;
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                ?>
                                <tr>
                                    <td><?= $no2; ?></td>
                                    <td><?= htmlspecialchars($row2['invoice']); ?></td>
                                    <td><?= htmlspecialchars($row2['id_customer']); ?></td>
                                    <td>
                                        <?php if ($row2['status'] == 'Menunggu Konfirmasi Pesanan') : ?>
                                            <span class="badge rounded-pill text-bg-warning"><?= $row2['status']?></span>
                                        <?php elseif ($row2['status'] == 'Menunggu Pembayaran') : ?>
                                            <span class="badge rounded-pill text-bg-danger"><?= $row2['status']?></span>
                                        <?php elseif ($row2['status'] == 'Pesanan Sedang Diproses') : ?>
                                            <span class="badge rounded-pill text-bg-primary"><?= $row2['status']?></span>
                                        <?php elseif ($row2['status'] == 'Pesanan Selesai') : ?>
                                            <span class="badge rounded-pill text-bg-success"><?= $row2['status']?></span>
                                        <?php elseif ($row2['status'] == 'Pesanan Telah Diambil') : ?>
                                            <span class="badge rounded-pill text-bg-secondary"><?= $row2['status']?></span>
                                        <?php elseif ($row2['status'] == 'Pesanan Ditolak') : ?>
                                            <span class="badge rounded-pill text-bg-danger"><?= $row2['status']?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row2['date_cart']; ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail<?= $row2['invoice']; ?>">
                                            Detail Pesanan
                                        </button>


                                        <!-- Modal -->
                                        <div class="modal fade" id="modalDetail<?= $row2['invoice']; ?>" tabindex="-1"
                                            aria-labelledby="modalLabel<?= $row2['invoice']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modalLabel<?= $row2['invoice']; ?>">Detail Pesanan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-borderless align-midlle text-left">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama</th>
                                                                    <th>Harga</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Sub Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $result3 = mysqli_query($conn, "SELECT pn.id_order, pn.invoice, pn.id_customer, p.id_product, p.name_product, pn.qty_cart, pn.price_cart FROM `bo-order` pn JOIN `bo-product` p ON pn.id_product = p.id_product WHERE invoice = '" . $row2['invoice'] . "'");
                                                                $no3 = 1;
                                                                $total_belanja = 0;
                                                                while ($row3 = mysqli_fetch_assoc($result3)) {

                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $no3; ?></td>
                                                                        <td><?= htmlspecialchars($row3['name_product']); ?></td>
                                                                        <td>Rp
                                                                            <?= number_format($row3['price_cart'], 0, ',', '.'); ?>
                                                                        </td>
                                                                        <td><?= htmlspecialchars($row3['qty_cart']); ?></td>
                                                                        <td>Rp
                                                                            <?php 
                                                                                $subtotal = $row3['qty_cart'] * $row3['price_cart'];
                                                                                $total_belanja += $subtotal;
                                                                                echo number_format($subtotal, 0, ',', '.'); 
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $no3++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="4" class="text-end"><b>Total Belanja</b></td>
                                                                    <td colspan="1" class="text-start"><b>Rp <?= number_format($total_belanja, 0, ',', '.'); ?></b></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php if ($row2['status'] == 'Menunggu Pembayaran') : ?>
                                            <!-- Menunggu Pembayaran -->
                                        
                                        <?php elseif ($row2['status'] == 'Pesanan Sedang Diproses') : ?>
                                            <!-- Tombol Pesanan Selesai -->
                                            <a href="proses/finish.php?inv=<?= $row2['invoice']; ?>"
                                                class="btn btn-success"
                                                onclick="return confirm('Yakin pesanan ini sudah selesai?')">
                                                <i class="glyphicon glyphicon-check"></i> Pesanan Selesai
                                            </a>
                                        <?php elseif ($row2['status'] == 'Pesanan Selesai') : ?>
                                            <!-- Tombol Pesanan Diambil -->
                                            <a href="proses/taken.php?inv=<?= $row2['invoice']; ?>"
                                                class="btn btn-success"
                                                onclick="return confirm('Yakin pesanan ini sudah diambil?')">
                                                <i class="glyphicon glyphicon-check"></i> Pesanan Sudah Diambil
                                            </a>

                                        <?php elseif ($row2['status'] == 'Pesanan Telah Diambil') : ?>
                                            <!-- Tombol Cetak Struk -->
                                            <a href="print-receipt.php?inv=<?= $row2['invoice']; ?>" class="btn btn-info" target="_blank">
                                                <i class="glyphicon glyphicon-print"></i> Cetak Struk
                                            </a>
                                        
                                        <?php elseif ($row2['status'] == 'Pesanan Ditolak') : ?>
                                            <!-- Menunggu Pembayaran -->
                                        <?php else : ?>
                                            <!-- Tombol Terima -->
                                            <a href="proses/accept.php?inv=<?= $row2['invoice']; ?>"
                                                class="btn btn-success"
                                                onclick="return confirm('Yakin ingin menerima pesanan ini?')">
                                                <i class="glyphicon glyphicon-ok-sign"></i> Terima
                                            </a>

                                            <!-- Tombol Tolak -->
                                            <a href="proses/reject.php?inv=<?= $row2['invoice']; ?>" class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menolak pesanan ini?')">
                                                <i class="glyphicon glyphicon-remove-sign"></i> Tolak
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $no2++;
                            }
                            ?>
                        </tbody>
                        <?php
                    } else {
                        echo "<tr><td colspan='7' class='text-center text-muted p-4'>Tidak ada pesanan sekarang, selamat bersantai :)</td></tr>";
                    } ?>
                </table>
            </div>
        </div>
    </div>
    
</body>

</html>