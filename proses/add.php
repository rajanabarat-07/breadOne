<?php
include "../config.php";

$hal = $_GET['hal'];
$id_customer = $_GET['id_customer'];
$id_product = $_GET['id_product'];
if (isset($_GET['qty_cart'])) {
	$qty = $_GET['qty_cart'];
}


$result = mysqli_query($conn, "SELECT * FROM `bo-product` WHERE id_product = '$id_product'");
$row = mysqli_fetch_assoc($result);

$name_product = $row['name_product'];
$id_product = $row['id_product'];
$price_product = $row['price_product'];
$default_status = 'Pastikan anda sudah memperbarui jumlah produk yang ingin dibeli.';



if ($hal == 1) {
	$cek = mysqli_query($conn, "SELECT * from `bo-cart` where id_product = '$id_product' and id_customer = '$id_customer'");
	$jml = mysqli_num_rows($cek);
	$row1 = mysqli_fetch_assoc($cek);

	if ($jml > 0) {
		$set = $row1['qty_cart'] + 1;
		$update = mysqli_query($conn, "UPDATE `bo-cart` SET qty_cart = '$set' WHERE id_product = '$id_product' and id_customer = '$id_customer'");
		if ($update) {
			echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = 'cart.php';
			</script>
			";
			die;
		}
	} else {

		$insert = mysqli_query($conn, "INSERT INTO `bo-cart` VALUES('','$id_customer','$id_product','$name_product', '1', '$price_product', '$default_status')");
		if ($insert) {
			echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = 'cart.php';
			</script>
			";
			die;
		}
	}


} else {
	$cek = mysqli_query($conn, "SELECT * from `bo-cart` where id_product = '$id_product' and id_customer = '$id_customer'");
	$jml = mysqli_num_rows($cek);
	$row1 = mysqli_fetch_assoc($cek);
	
	if ($jml > 0) {
		$set = $row1['qty_cart'] + $qty;
		$update = mysqli_query($conn, "UPDATE `bo-cart` SET qty_cart = '$set' WHERE id_product = '$id_product' and id_customer = '$id_customer'");
		if ($update) {
			echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = '../product-detail.php?id=" . $id_product . "';
			</script>
			";
			die;
		}
	} else {

		$insert = mysqli_query($conn, "INSERT INTO `bo-cart` VALUES('','$id_customer','$id_product','$name_product', '$qty', '$price_product', '$default_status')");
		if ($insert) {
			echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = '../product-detail.php?id=" . $id_product . "';
			</script>
			";
			die;
		}

	}






}
?>