    <?php
    include '../config.php';

    function getNamaBahan($conn, $id) {
        $q = mysqli_query($conn, "SELECT name_ingredient FROM `bo-ingredient` WHERE id_ingredient = '$id'");
        $d = mysqli_fetch_assoc($q);
        return $d ? $d['name_ingredient'] : 'Unknown';
    }
    

    if (isset($_POST['add_stock_btn'])) {
        $id_products = $_POST['id_product'];
        $add_stocks = $_POST['add_stock'];

        for ($i = 0; $i < count($id_products); $i++) {
            $id_product = $id_products[$i];
            $stock_to_add = (int)$add_stocks[$i];

            if ($stock_to_add > 0) {
                // Ambil umur simpan produk
                $query = mysqli_query($conn, "SELECT life_product FROM `bo-product` WHERE id_product = '$id_product'");
                $row = mysqli_fetch_assoc($query);
                $shelf_life = (int)$row['life_product'];
            
                // Cek semua bahan baku cukup atau tidak
                $bom_query = mysqli_query($conn, "SELECT * FROM `bo-bom` WHERE id_product = '$id_product'");
                $bahan_baku_cukup = true;
                $bahan_list = [];
            
                while ($bom_row = mysqli_fetch_assoc($bom_query)) {
                    $id_ingredient = $bom_row['id_ingredient'];
                    $amount_needed = $bom_row['require_ingredient'];
                    $total_needed = $amount_needed * $stock_to_add;
            
                    $ingredient_query = mysqli_query($conn, "SELECT qty_ingredient FROM `bo-ingredient` WHERE id_ingredient = '$id_ingredient'");
                    $ingredient_row = mysqli_fetch_assoc($ingredient_query);
                    $current_stock = (int)$ingredient_row['qty_ingredient'];
            
                    if ($current_stock < $total_needed) {
                        $bahan_baku_cukup = false;
                    
                        $bahan_kurang_list[] = [
                            'id_ingredient' => $id_ingredient,
                            'nama_bahan' => getNamaBahan($conn, $id_ingredient),
                            'butuh' => $total_needed,
                            'stok' => $current_stock,
                            'kurang' => $total_needed - $current_stock
                        ];
                        break;
                    }
                    
                    // untuk update stok
                    $bahan_update_list[] = [
                        'id_ingredient' => $id_ingredient,
                        'new_stock' => $current_stock - $total_needed
                    ];
                }                    
            
                if (!$bahan_baku_cukup) {
                    ?>
                    <!DOCTYPE html>
                    <html lang="id">
                    <head>
                        <meta charset="UTF-8">
                        <title>Produksi Gagal</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                    </head>
                    <body>
                    <div class="container mt-5">
                        <div class="alert alert-danger shadow">
                            <h4 class="alert-heading">⚠️ Produksi Gagal</h4>
                            <p>Stok bahan baku tidak cukup untuk memproduksi produk ID <strong><?= $id_product ?></strong>.</p>
                        </div>
                
                        <div class="card">
                            <div class="card-header bg-warning text-dark fw-bold">Detail Kekurangan Bahan Baku</div>
                            <div class="card-body p-0">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Bahan</th>
                                            <th>Stok Saat Ini</th>
                                            <th>Kebutuhan</th>
                                            <th class="text-danger">Kekurangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bahan_kurang_list as $bahan): ?>
                                            <tr>
                                                <td><?= $bahan['nama_bahan'] ?></td>
                                                <td><?= $bahan['stok'] ?></td>
                                                <td><?= $bahan['butuh'] ?></td>
                                                <td class="text-danger fw-bold"><?= $bahan['kurang'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                
                        <div class="mt-4 text-end">
                            <a href="production.php" class="btn btn-primary">Kembali ke Stok Produk</a>
                        </div>
                    </div>
                    </body>
                    </html>
                    <?php
                    exit;
                }                              
            
                // Kurangi bahan baku
                foreach ($bahan_update_list as $bahan) {
                    $update_ingredient = "UPDATE `bo-ingredient` SET qty_ingredient = {$bahan['new_stock']} WHERE id_ingredient = '{$bahan['id_ingredient']}'";
                    mysqli_query($conn, $update_ingredient);
                }                
            
                // Tambah stok produk
                $update = "UPDATE `bo-product` SET stock_product = stock_product + $stock_to_add WHERE id_product = '$id_product'";
                mysqli_query($conn, $update);
            
                // Simpan log produksi
                $tanggal_produksi = date('Y-m-d');
                $tanggal_kedaluwarsa = date('Y-m-d', strtotime("+$shelf_life days"));
                $log = "INSERT INTO `bo-production` VALUES ('', '$id_product', '$stock_to_add', '$tanggal_produksi', '$tanggal_kedaluwarsa')";
                mysqli_query($conn, $log);
            }            
        }

        header("Location: product-stock.php?success=1");
        exit;
    }

    $result = mysqli_query($conn, "SELECT * FROM `bo-product`");
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Tambah Stok Produk</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .quantity-control {
                display: flex;
                align-items: center;
            }
            .quantity-btn {
                padding: 0.4rem 0.75rem;
                border: 1px solid #ced4da;
                background-color: #f8f9fa;
                cursor: pointer;
            }
            .quantity-input {
                width: 70px;
                text-align: center;
                border: 1px solid #ced4da;
                margin: 0 5px;
            }
        </style>
    </head>
    <body>
        <?php include "../Layout/sidebar.php"; ?>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Stok Produk</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success">Stok berhasil ditambahkan!</div>
                <?php endif; ?>

                <form method="POST">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Produk</th>
                                <th>Stok Sekarang</th>
                                <th>Tambah Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php mysqli_data_seek($result, 0); while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?= $row['name_product'] ?></td>
                                    <td><?= $row['stock_product'] ?></td>
                                    <td>
                                        <input type="hidden" name="id_product[]" value="<?= $row['id_product'] ?>">
                                        <div class="quantity-control">
                                            <button type="button" class="quantity-btn" onclick="changeQuantity(this, -1)">-</button>
                                            <input type="number" name="add_stock[]" class="quantity-input" value="0" min="0">
                                            <button type="button" class="quantity-btn" onclick="changeQuantity(this, 1)">+</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        <button type="submit" name="add_stock_btn" class="btn btn-success">Tambah Semua Stok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function changeQuantity(button, delta) {
            const input = button.parentElement.querySelector("input[type='number']");
            let value = parseInt(input.value);
            if (isNaN(value)) value = 0;
            value += delta;
            if (value < 0) value = 0;
            input.value = value;
        }
    </script>
    </body>
    </html>
