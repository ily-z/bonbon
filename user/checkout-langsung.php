<?php
session_start();
if (empty($_SESSION['nama'])) {
    echo "<script> window.location.href='../masuk.php' </script>";
    exit;
}
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
if ($_SESSION['hak'] != 'pengguna') {
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>";
    exit;
}
include "../conf/connection.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | Bonbon Bakery</title>
  <link rel="shortcut icon" href="../assets/ico/barley.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body { background-color: #f3e3cd; font-family: 'Sora', sans-serif; }
    .checkout-card { background-color: #fff3e0; border: 2px solid #c9aa7b; padding: 40px; margin: 60px auto; max-width: 700px; border-radius: 20px; }
    .checkout-title { font-family: 'Sansita Swashed', cursive; color: #ad8d5c; font-size: 2rem; text-align: center; margin-bottom: 30px; }
    .cart-list { max-height: 250px; overflow-y: auto; margin-bottom: 20px; }
    .cart-item { display: flex; align-items: center; border-bottom: 1px solid #eee; padding: 10px 0; }
    .cart-item:last-child { border-bottom: none; }
    .cart-item img { width: 48px; height: 48px; object-fit: cover; border-radius: 8px; margin-right: 12px; }
    .cart-item .item-info { flex: 1; }
    .cart-item .item-title { font-weight: bold; font-size: 1rem; }
    .cart-item .item-qty { font-size: 0.9rem; color: #888; }
    .cart-item .item-total { font-weight: bold; font-size: 1rem; color: #ad8d5c; }
    .checkout-form label { font-weight: bold; }
    .checkout-form input[type='text'] { border-radius: 10px; border: 1px solid #c9aa7b; padding: 8px 14px; margin-bottom: 15px; }
    .btn-checkout { background-color: #c9aa7b; color: white; font-weight: bold; border-radius: 20px; padding: 10px 30px; font-size: 1rem; margin-top: 20px; }
    .btn-checkout:disabled { opacity: 0.6; }
    .total-row { display: flex; justify-content: space-between; font-weight: bold; font-size: 1.1rem; margin-top: 20px; }
  </style>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-4 mb-5">
  <div class="checkout-card shadow-lg">
    <div class="checkout-title">Checkout</div>
    <?php 
      $sql = "SELECT * FROM barang 
              INNER JOIN keranjang ON barang.id_barang = keranjang.id_barang 
              WHERE keranjang.id_pengguna='$id' AND status='langsung beli'";
      $query = mysqli_query($connect, $sql);
      $cart_items = [];
      $cart_total = 0;
      while($row = mysqli_fetch_assoc($query)) {
        $cart_items[] = $row;
        $cart_total += $row['total'];
      }
    ?>
    <?php if (count($cart_items) === 0): ?>
      <div class="alert alert-warning text-center">Tidak ada barang untuk checkout langsung.</div>
    <?php else: ?>
    <form method="POST" action="proses-checkout-langsung.php" class="checkout-form">
      <div class="cart-list mb-3">
        <?php foreach($cart_items as $item): ?>
          <div class="cart-item">
            <img src="../images/product/<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama_barang']); ?>">
            <div class="item-info">
              <div class="item-title"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
              <div class="item-qty">Qty: <?php echo $item['jumlah_beli']; ?> x Rp<?php echo number_format($item['harga']); ?></div>
            </div>
            <div class="item-total">Rp<?php echo number_format($item['total']); ?></div>
            <input type="hidden" name="id_keranjang[]" value="<?php echo $item['id_keranjang']; ?>">
          </div>
        <?php endforeach; ?>
      </div>
      <div class="total-row">
        <span>Total</span>
        <span>Rp<?php echo number_format($cart_total); ?></span>
      </div>
      <input type="hidden" name="sub" value="<?php echo $cart_total; ?>">
      <label for="alamat">Alamat Pengiriman</label>
      <input type="text" name="alamat" id="alamat" maxlength="100" class="form-control" required>
      <label for="no_hp">No HP</label>
      <input type="text" name="no_hp" id="no_hp" maxlength="15" class="form-control" required>
      <button type="submit" class="btn btn-checkout w-100 mt-3">Konfirmasi &amp; Bayar</button>
    </form>
    <?php endif; ?>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 