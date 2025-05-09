<?php 
include "config.php";

$id_customer = mysqli_real_escape_string($conn,$_GET['id_customer']);
$customer = mysqli_query($conn, "SELECT * FROM `bo-customer` WHERE id_customer = '$id_customer'");
$rows = mysqli_fetch_assoc($customer);

require_once 'vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-5f0agzIE4Rpm3TVWp1HGSx4I';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Hitung total belanjaan
$hasil = 0;
$cart = mysqli_query($conn, "SELECT * FROM `bo-cart` WHERE id_customer = '$id_customer'");
while($row = mysqli_fetch_assoc($cart)) {
    $subtotal = $row['price_cart'] * $row['qty_cart'];
    $hasil += $subtotal;
}

$params = array(
    'transaction_details' => array(
        'order_id' => 'BREAD-' . time(), // unik
        'gross_amount' => $hasil,
    ),
    'customer_details' => array(
        'first_name' => $rows['name_customer'],
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Order</title>
</head>
<body>
    <?php include 'Layout/header.php'; ?>
<div class="container" style="padding-bottom: 200px">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Checkout</b></h2>
	<div class="row">
		<div class="col-md-6">
			<h4>Daftar Pesanan</h4>
			<p>
				<i style="color: red;">Note:
					<ol>
						<li>Pastikan pesanan anda sudah benar</li>
						<li>Pesanan akan diambil di tempat/toko langsung</li>
					</ol>
				</i>
			</p>
			<table class="table table-stripped">
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Qty</th>
					<th>Sub Total</th>
				</tr>
				<?php 
				$result = mysqli_query($conn, "SELECT * FROM `bo-cart` WHERE id_customer = '$id_customer'");
				$no = 1;
				$hasil = 0;
				while($row = mysqli_fetch_assoc($result)){
					?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $row['name_product']; ?></td>
						<td>Rp.<?= number_format($row['price_cart']); ?></td>
						<td><?= $row['qty_cart']; ?></td>
						<td>Rp.<?= number_format($row['price_cart'] * $row['qty_cart']);  ?></td>
					</tr>
					<?php 
					$total = $row['price_cart'] * $row['qty_cart'];
					$hasil += $total;
					$no++;
				}
				?>
				<tr>
					<td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = <?= number_format($hasil); ?></td>
				</tr>
			</table>
		</div>
	</div>

	<br>
	<!-- Tombol bayar -->
<button id="pay-button" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Bayar Sekarang</button>
<a href="cart.php" class="btn btn-danger">Cancel</a>

<form id="order-form" action="proses/order.php" method="POST" style="display: none;">
    <input type="hidden" name="id_customer" value="<?= $id_customer; ?>">
    <input type="hidden" name="order_id" id="order-id">
    <input type="hidden" name="status_pembayaran" id="status-pembayaran">
</form>

</div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-26NtNHGdophHJxY4"></script>
<script type="text/javascript">
document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('<?= $snapToken ?>', {
        onSuccess: function(result){
            // Pembayaran sukses
            document.getElementById('order-id').value = result.order_id;
            document.getElementById('status-pembayaran').value = result.transaction_status;
            document.getElementById('order-form').submit();
        },
        onPending: function(result){
            // Masih menunggu pembayaran
            document.getElementById('order-id').value = result.order_id;
            document.getElementById('status-pembayaran').value = result.transaction_status;
            document.getElementById('order-form').submit();
        },
        onError: function(result){
            alert("Pembayaran gagal!");
            console.log(result);
        }
    });
});
</script>

</body>
</html>
