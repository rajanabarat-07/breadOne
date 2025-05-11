<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart = json_decode($_POST['data_penjualan'], true);

    if (!$cart || count($cart) == 0) {
        echo "Tidak ada produk yang dijual.";
        exit;
    }

    $tanggal = date('Y-m-d H:i:s');
    $total = 0;

    // Hitung total penjualan
    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }

    // Simpan ke bo_sales
    $insert_sales = "INSERT INTO bo_sales  VALUES ('', '$tanggal', '$total')";
    mysqli_query($conn, $insert_sales);
    $id_sales = mysqli_insert_id($conn); // Ambil ID penjualan terbaru

    // Simpan setiap item ke bo_sales_detail dan kurangi stok produk
    foreach ($cart as $item) {
        $id_product = $item['id'];
        $qty = (int)$item['qty'];
        $harga = (int)$item['price'];

        // Simpan ke detail
        $insert_detail = "INSERT INTO bo_sales_detail (id_sales, id_product, qty, harga)
                          VALUES ('$id_sales', '$id_product', '$qty', '$harga')";
        mysqli_query($conn, $insert_detail);

        // Kurangi stok produk
        $update_stok = "UPDATE `bo-product` SET stock_product = stock_product - $qty WHERE id_product = '$id_product'";
        mysqli_query($conn, $update_stok);
    }

    // Redirect atau tampilkan pesan sukses
    header("Location: ../product-sell.php?sukses=1");
    exit;
}
?>
