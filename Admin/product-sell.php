<?php
include '../config.php';
$result = mysqli_query($conn, "SELECT * FROM `bo-product`");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Penjualan Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .table-summary td, .table-summary th { vertical-align: middle; }
  </style>
</head>
<body>
  <?php include '../Layout/sidebar.php'; ?>
  <div class="container mt-5">
    <h3>Form Penjualan Produk (Admin)</h3>
    <div class="row mb-3">
      <div class="col-md-5">
        <label for="product">Pilih Produk</label>
        <select id="product" class="form-select">
          <option value="">-- Pilih Produk --</option>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <option 
              value="<?= $row['id_product'] ?>" 
              data-name="<?= $row['name_product'] ?>" 
              data-price="<?= $row['price_product'] ?>" 
              data-stock="<?= $row['stock_product'] ?>">
              <?= $row['name_product'] ?> (Stok: <?= $row['stock_product'] ?>)
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-3">
        <label for="qty">Jumlah</label>
        <input type="number" id="qty" class="form-control" min="1" value="1">
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button onclick="addToCart()" class="btn btn-primary w-100">Tambah ke Daftar Jual</button>
      </div>
    </div>

    <?php if (isset($_GET['sukses'])): ?>
        <div class="alert alert-success">Penjualan berhasil disimpan!</div>
    <?php endif; ?>

    <form method="POST" action="proses/sell.php">
      <table class="table table-bordered table-summary">
        <thead class="table-light">
          <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="cart-body">
          <!-- Cart items will appear here -->
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="text-end">Total:</th>
            <th id="total-harga">Rp 0</th>
            <th></th>
          </tr>
        </tfoot>
      </table>

      <input type="hidden" name="data_penjualan" id="data_penjualan">
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Proses Penjualan</button>
      </div>
    </form>
  </div>

<script>
let cart = [];

function formatRupiah(angka) {
  return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


function addToCart() {
  const select = document.getElementById('product');
  const id = select.value;
  const name = select.options[select.selectedIndex].getAttribute('data-name');
  const price = parseInt(select.options[select.selectedIndex].getAttribute('data-price'));
  const stock = parseInt(select.options[select.selectedIndex].getAttribute('data-stock'));
  const qty = parseInt(document.getElementById('qty').value);

  if (!id || qty < 1 || qty > stock) {
    alert('Jumlah tidak valid atau stok tidak mencukupi.');
    return;
  }

  const existing = cart.find(item => item.id === id);
  if (existing) {
    existing.qty += qty;
  } else {
    cart.push({ id, name, price, qty });
  }

  updateCartTable();
}

function updateCartTable() {
  const body = document.getElementById('cart-body');
  const totalCell = document.getElementById('total-harga');
  body.innerHTML = '';
  let total = 0;

  cart.forEach((item, index) => {
    const subtotal = item.qty * item.price;
    total += subtotal;

    const row = `
      <tr>
        <td>${item.name}<input type="hidden" name="id_product[]" value="${item.id}"></td>
        <td>${formatRupiah(item.price)}</td>
        <td>${item.qty}<input type="hidden" name="qty[]" value="${item.qty}"></td>
        <td>${formatRupiah(subtotal)}</td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button></td>
      </tr>
    `;
    body.innerHTML += row;
  });

  totalCell.textContent = formatRupiah(total);
  document.getElementById('data_penjualan').value = JSON.stringify(cart);
}

function removeItem(index) {
  cart.splice(index, 1);
  updateCartTable();
}
</script>
</body>
</html>
