<?php 
include "config.php";
$id_customer = mysqli_real_escape_string($conn,$_GET['id_customer']);
$customer = mysqli_query($conn, "SELECT * FROM `bo-customer` WHERE id_customer = '$id_customer'");
$rows = mysqli_fetch_assoc($customer);
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
	<form action="proses/order.php" method="POST">
        <input type="hidden" name="id_customer" value="<?= $id_customer; ?>">
		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang</button>
		<a href="cart.php" class="btn btn-danger">Cancel</a>
	</form>
</div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
