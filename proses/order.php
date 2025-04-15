<?php
include "../config.php";

$id_customer = $_POST['id_customer'];

$invoice = mysqli_query($conn, "SELECT invoice FROM `bo-order` ORDER BY invoice DESC");
$data = mysqli_fetch_assoc($invoice);
$num = substr($data['invoice'], 3, 4);
$add = (int) $num + 1;

if(strlen($add) == 1){
	$format = "INV000".$add;
}else if(strlen($add) == 2){
	$format = "INV00".$add;
}
else if(strlen($add) == 3){
	$format = "INV0".$add;
}else{
	$format = "INV".$add;
}

$cart = mysqli_query($conn, "SELECT * FROM `bo-cart` WHERE id_customer = $id_customer");

while($row = mysqli_fetch_assoc($cart)){
    $id_product = $row['id_product'];
    $name_product = $row['name_product'];
    $qty_cart = $row['qty_cart'];
    $price_cart = $row['price_cart'];
    $status = "Menunggu Konfirmasi Pesanan";
    date_default_timezone_set('Asia/Jakarta');
    $date_cart = date('Y-m-d H:i:s');
    $insert = mysqli_query($conn, "INSERT INTO `bo-order` VALUES ('','$format','$id_customer','$id_product','$name_product', '$qty_cart','$price_cart','$status', '$date_cart')");
    if($insert){
        $del = mysqli_query($conn, "DELETE FROM `bo-cart` WHERE id_customer = '$id_customer'");
        if($del){
            echo "
            <script>
            alert('Request Pesanan Berhasil, Silahkan Tunggu Konfirmasi dari Admin!');
            window.location = '../cart.php';
            </script>
            ";
        }
    }
}
?>