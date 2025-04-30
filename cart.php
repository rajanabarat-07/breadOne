<?php
include 'Layout/header.php'; // Include database connection

$alert = "";

if (isset($_POST['submit1'])) {
    $id_cart = $_POST['id_cart'];
    $qty_cart = $_POST['qty_cart'];
    

    $edit = mysqli_query($conn, "UPDATE `bo-cart` SET qty_cart = '$qty_cart' WHERE id_cart = '$id_cart'");
    if ($edit) {
        $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Keranjang berhasil diperbarui.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
    }
} else if (isset($_GET['del'])) {
    $id_cart = $_GET['id_cart'];
    $del = mysqli_query($conn, "DELETE FROM `bo-cart` WHERE id_cart = '$id_cart'");
    if ($del) {
        $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        1 produk dihapus dari keranjang.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orders</title>
        <style>
        .stock-alert-floating {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: auto;
            max-width: 400px;
        }

        .floating-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: auto;
            max-width: 400px;
        }
        </style>
    </head>
    
<body>
<div id="stock-alert-container" class="stock-alert-floating"></div>
        <!-- Ganti bagian tabel dari file kamu seperti ini -->
        <div class="floating-alert">
            <?php if ($alert !== "") echo $alert; ?>
        </div>
    <div class="p-4">
        <div class="card shadow-lg p-4 mb-3">
            <h3 class="text-center mb-4">Keranjang Belanja</h3>
            <div class="table-responsive">
                <table class="table table-borderless align-middle text-center">
                    <?php
                    if (isset($_SESSION['name_customer'])) {
                        $id_customer = $_SESSION['id_customer'];
                        $cek = mysqli_query($conn, "SELECT * FROM `bo-cart` WHERE id_customer = '$id_customer'");
                        $jml = mysqli_num_rows($cek);

                        $cek2 = mysqli_query($conn, "SELECT * FROM `bo-order` WHERE id_customer = '$id_customer'");
                        $jml2 = mysqli_num_rows($cek2);

                        if ($jml > 0) {
                            ?>
                            <thead class="table-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($conn, "SELECT c.id_cart, c.id_product, c.name_product, c.qty_cart, c.status, p.image_product, p.price_product, p.stock_product FROM `bo-cart` c JOIN `bo-product` p ON c.id_product = p.id_product WHERE id_customer = '$id_customer'");
                                $no = 1;
                                $hasil = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <input type="hidden" name="id_cart" value="<?= $row['id_cart']; ?>">
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td>
                                                <img src="Images/<?= htmlspecialchars($row['image_product']); ?>"
                                                    alt="Gambar Produk" class="img-fluid rounded" style="max-width: 70px;">
                                            </td>
                                            <td><?= htmlspecialchars($row['name_product']); ?></td>
                                            <td>Rp <?= number_format($row['price_product'], 0, ',', '.'); ?></td>
                                            <td>
                                            <input type="number" 
                                                    name="qty_cart" 
                                                    class="form-control text-center mx-auto qty-input"
                                                    value="<?= $row['qty_cart']; ?>" 
                                                    min="1" 
                                                    data-stock="<?= $row['stock_product']; ?>" 
                                                    style="max-width: 80px;">
                                            </td>
                                            <td>Rp <?= number_format($row['qty_cart'] * $row['price_product'], 0, ',', '.'); ?></td>

                                            <td class="d-flex flex-column gap-1">
                                                <button type="submit" name="submit1"
                                                    class="btn btn-warning btn-sm">Perbarui</button>
                                                <a href="cart.php?del=1&id_cart=<?= $row['id_cart']; ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin dihapus?')">Hapus</a>
                                                <a href="product-detail.php?id=<?= $row["id_product"]; ?>"
                                                    class="btn btn-info btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    </form>
                                    <?php
                                    $sub = $row['qty_cart'] * $row['price_product'];
                                    $hasil += $sub;
                                    $no++;
                                }
                                ?>
                                <tr class="table-light">
                                    <td colspan="5" class="text-end"><b>Total Belanja</b></td>
                                    <td colspan="3" class="text-start"><b>Rp <?= number_format($hasil, 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="text-end">
                                        <a href="product.php" class="btn btn-primary">Lanjutkan Belanja</a>
                                        <a href="request-order.php?id_customer=<?= $id_customer; ?>"
                                            class="btn btn-success">Request Pesanan</a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                        } else {
                            echo "<tr><td colspan='8' class='text-center text-muted p-4'>Kamu belum memesan apapun. Yuk, pilih roti favoritmu!</td></tr>";
                        }
                    
                    ?>
                </table>
            </div>
        </div>

        <div class="card shadow-lg p-4">
            <h3 class="text-center mb-4">Riwayat Belanja</h3>
            <div class="table-responsive">
                <table class="table table-borderless align-middle text-center">
                    <?php
                    if ($jml2 > 0) {
                        // Ambil semua invoice unik milik user
                        $invoice_query = mysqli_query($conn, "SELECT DISTINCT invoice, status FROM `bo-order` WHERE id_customer = '$id_customer' ORDER BY invoice DESC");
                        $no_invoice = 1;
                        ?>
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Invoice</th>
                                <th>Detail Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($inv = mysqli_fetch_assoc($invoice_query)) {
                                $invoice = $inv['invoice'];
                                $status = $inv['status'];
                                
                                // Ambil semua produk dari invoice ini
                                $produk_query = mysqli_query($conn, "SELECT p.name_product, pn.qty_cart, pn.price_cart FROM `bo-order` pn JOIN `bo-product` p ON pn.id_product = p.id_product WHERE pn.invoice = '$invoice'");
                                $total_harga = 0;
                                ob_start(); // buffer HTML produk
                                ?>
                                <table class="table table-sm text-start">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($prod = mysqli_fetch_assoc($produk_query)) :
                                            $subtotal = $prod['qty_cart'] * $prod['price_cart'];
                                            $total_harga += $subtotal;
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($prod['name_product']); ?></td>
                                                <td><?= $prod['qty_cart']; ?></td>
                                                <td>Rp <?= number_format($prod['price_cart'], 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <?php
                                $produk_html = ob_get_clean();
                                ?>
                                <tr>
                                    <td><?= $no_invoice++; ?></td>
                                    <td><?= $invoice; ?></td>
                                    <td><?= $produk_html; ?></td>
                                    <td><b>Rp <?= number_format($total_harga, 0, ',', '.'); ?></b></td>
                                    <td>
                                        <?php if ($status == 'Menunggu Konfirmasi Pesanan') : ?>
                                            <span class="badge rounded-pill text-bg-warning"><?= $status?></span>
                                        <?php elseif ($status == 'Menunggu Pembayaran') : ?>
                                            <span class="badge rounded-pill text-bg-danger"><?= $status?></span>
                                        <?php elseif ($status == 'Pesanan Sedang Diproses') : ?>
                                            <span class="badge rounded-pill text-bg-primary"><?= $status?></span>
                                        <?php elseif ($status == 'Pesanan Selesai') : ?>
                                            <span class="badge rounded-pill text-bg-success"><?= $status?></span>
                                        <?php elseif ($status == 'Pesanan Telah Diambil') : ?>
                                            <span class="badge rounded-pill text-bg-secondary"><?= $status?></span>
                                        <?php elseif ($status == 'Pesanan Ditolak') : ?>
                                            <span class="badge rounded-pill text-bg-danger"><?= $status?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($status === 'Menunggu Pembayaran') : ?>
                                            <a href="proses/pay.php?inv=<?= $invoice; ?>" class="btn btn-sm btn-primary">Bayar Sekarang</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <?php
                    } else {
                        echo "<tr><td colspan='6' class='text-center text-muted p-4'>Kamu belum pernah mesan di bread one nih, cobain deh pasti enak!</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center text-muted p-4'>Kamu Belum Login Nih, <a href='login.php'>Yuk Login.</a></td></tr>";
                }
                    ?>
                </table>
            </div>
        </div>

    </div>
    
    <!-- Script untuk validasi stock dan permintaan customer -->
    <script>
        // Saat input qty diubah
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('input', function () {
                const maxStock = parseInt(this.dataset.stock);
                const currentValue = parseInt(this.value);
                const oldValue = this.defaultValue;

                if (currentValue > maxStock) {
                    const alertContainer = document.getElementById('stock-alert-container');
                    alertContainer.innerHTML = `
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> Stok tidak cukup untuk produk ini.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                    setTimeout(() => {
                        alertContainer.innerHTML = '';
                    }, 3000); // hilang setelah 3 detik

                    this.value = oldValue;
                } else {
                    this.defaultValue = currentValue;
                }
            });
        });
    </script>

    <script>
        setTimeout(() => {
            const alertElement = document.querySelector('.floating-alert .alert');
            if (alertElement) {
                alertElement.classList.remove('show');
                alertElement.classList.add('hide');
            }
        }, 3000); // 3 detik
    </script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>