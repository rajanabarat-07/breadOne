<?php
    include "config.php";
    $id = $_GET["id"];

    if (delCart($id) > 0) {
        echo "
            <script>
                alert('Produk berhasil dihapus');
                document.location.href = 'cart.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Produk gagal dihapus');
                document.location.href = 'cart.php';
            </script>
        ";
    }
?>