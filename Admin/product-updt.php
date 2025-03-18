<?php 
    include "../config.php";

    $id_product = $_GET["id"];

    $product = query("SELECT * FROM `bo-product` WHERE id_product = $id_product")[0];

    if(isset($_POST['submit'])) {
        if(updt($_POST) > 0) {
            echo"
                <script>
                    alert('Produk berhasil diperbarui');
                    document.location.href = 'product-index.php';
                </script>
            ";
        } else {
            echo"
                <script>
                    alert('Produk gagal diperbarui');
                    document.location.href = 'product-updt.php';
                </script>
            ";
        }
    }    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bread One</title>
    </head>
    <body>
        <h1>Perbarui Produk</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_product" value="<?= $product["id_product"]; ?>">
            <input type="hidden" name="old_image" value="<?= $product["old_image"]; ?>">
            <ul>
                <li>
                    <label for="image_product">Gambar Produk</label><br>
                    <img src="../Images/<?= $product['image_product']; ?>" width="100" alt=""><br>
                    <input type="file" name="image_product" id="image_product" >
                </li>
                <li>
                    <label for="name_product">Nama Produk</label>
                    <input type="text" name="name_product" id="name_product" required value="<?= $product["name_product"] ?>">
                </li>
                <li>
                    <label for="description_product">Deskripsi Produk</label>
                    <input type="text" name="description_product" id="description_product" required value="<?= $product["description_product"] ?>">
                </li>
                <li>
                    <label for="price_product">Harga Produk</label>
                    <input type="text" name="price_product" id="price_product" required value="<?= $product["price_product"] ?>">
                </li>
                <li>
                    <label for="id_category">Ketogori Produk</label>
                    <input type="text" name="id_category" id="id_category" required value="<?= $product["id_category"] ?>">
                </li>
                <li>
                    <button type="submit" name="submit">Perbarui Produk</button>
                </li>
            </ul>
        </form>
    </body>
</html>