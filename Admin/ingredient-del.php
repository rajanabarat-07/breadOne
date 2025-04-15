<?php
    include "../config.php";
    $id = $_GET["id"];

    if (delIng($id) > 0) {
        echo "
            <script>
                alert('Bahan berhasil dihapus');
                document.location.href = 'ingredient-index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Bahan gagal dihapus');
                document.location.href = 'ingredient-add.php';
            </script>
        ";
    }
?>