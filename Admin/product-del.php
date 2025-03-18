<?php
    include "../config.php";
    $id = $_GET["id"];

    if (del($id) > 0) {
        echo "
            <script>
                alert('Produk berhasil dihapus');
                document.location.href = 'product-index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Produk gagal dihapus');
                document.location.href = 'product-add.php';
            </script>
        ";
    }
?>