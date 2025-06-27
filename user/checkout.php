<?php 
session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../masuk.php' </script>
<?php }
if($_SESSION['hak'] != 'pengguna'){ ?>
    <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>
<?php }
include "../conf/connection.php";

$id_pengguna = $_SESSION['id'];
$waktu = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // PROSES CHECKOUT
  $subtotal = $_POST['sub'] ?? 0;
  $alamat = $_POST['alamat'] ?? '';
  $no_hp = $_POST['no_hp'] ?? '';
  $id_keranjang = $_POST['id_keranjang'] ?? [];

  // Simpan transaksi
  $insert = "INSERT INTO transaksi (waktu_transaksi, subtotal, status_transaksi, alamat, no_hp, id_pengguna) 
             VALUES ('$waktu', '$subtotal', 'proses kirim', '$alamat', '$no_hp', '$id_pengguna')";
  $sukses = mysqli_query($connect, $insert);

  // Ambil ID transaksi yang baru saja disimpan
  $id_transaksi_baru = mysqli_insert_id($connect);

  // Ambil detail barang dari keranjang sebelum dihapus
  if (!empty($id_keranjang)) {
      foreach($id_keranjang as $idk){
          $idk = intval($idk);
          // Ambil data barang dari keranjang
          $q = mysqli_query($connect, "SELECT k.*, b.nama_barang, b.gambar, b.harga FROM keranjang k JOIN barang b ON k.id_barang = b.id_barang WHERE k.id_keranjang='$idk'");
          if($row = mysqli_fetch_assoc($q)) {
              $id_barang = $row['id_barang'];
              $nama_barang = mysqli_real_escape_string($connect, $row['nama_barang']);
              $gambar = mysqli_real_escape_string($connect, $row['gambar']);
              $harga = $row['harga'];
              $jumlah = $row['jumlah_beli'];
              // Insert ke detail_transaksi
              $ins_detail = "INSERT INTO detail_transaksi (id_transaksi, id_barang, nama_barang, gambar, harga, jumlah) VALUES ('$id_transaksi_baru', '$id_barang', '$nama_barang', '$gambar', '$harga', '$jumlah')";
              mysqli_query($connect, $ins_detail);
          }
          // Update status dan waktu keranjang dengan ID transaksi, lalu HAPUS dari keranjang
          $update = "UPDATE keranjang SET waktu='$waktu', status='proses kirim', id_transaksi='$id_transaksi_baru' WHERE id_keranjang='$idk'";
          mysqli_query($connect, $update);
          $delete = "DELETE FROM keranjang WHERE id_keranjang='$idk'";
          mysqli_query($connect, $delete);
      }
  }
  ?>
  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Sukses | Bonbon Bakery</title>
    <link rel="shortcut icon" href="../assets/ico/barley.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
      body { background-color: #f3e3cd; font-family: 'Sora', sans-serif; }
      .success-card { background-color: #fff3e0; border: 2px dashed #c9aa7b; padding: 50px; margin: 100px auto; max-width: 700px; border-radius: 20px; text-align: center; }
      .success-card h2 { font-family: 'Sansita Swashed', cursive; color: #ad8d5c; font-size: 2rem; }
      .success-card p { font-size: 1.1rem; margin-top: 20px; }
      .btn-ok { background-color: #c9aa7b; color: white; font-weight: bold; font-family: 'Sora', sans-serif; padding: 10px 30px; font-size: 1rem; border-radius: 30px; margin-top: 30px; }
    </style>
  </head>
  <body>
  <div class="container">
    <div class="success-card shadow-lg">
      <h2><i class="bi bi-check-circle-fill text-success"></i> Barang Anda Akan Segera Dikirim</h2>
      <p>
        Pesanan Anda telah berhasil dikonfirmasi.<br>
        Silakan cek status pengiriman melalui menu 
        <i class="bi bi-send-fill text-primary"></i> <strong>Pengiriman</strong> pada navbar.<br><br>
        Lakukan pembayaran saat barang diterima kepada kurir kami.<br>
        Setelah barang diterima, klik tombol 
        <span class="badge bg-primary">Barang Diterima</span> di halaman pengiriman.
      </p>
      <a href="pengiriman.php" class="btn btn-ok">OK</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
  <?php
  exit;
}
// TAMPILKAN FORM CHECKOUT
$cart_items = [];
$cart_total = 0;
$qcart = mysqli_query($connect, "SELECT k.id_keranjang, k.jumlah_beli, k.total, b.nama_barang, b.gambar, b.harga FROM keranjang k JOIN barang b ON k.id_barang = b.id_barang WHERE k.id_pengguna='$id_pengguna' AND k.status='belum bayar'");
while($row = mysqli_fetch_assoc($qcart)) {
  $cart_items[] = $row;
  $cart_total += $row['total'];
}
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
<div class="container">
  <div class="checkout-card shadow-lg">
    <div class="checkout-title">Checkout</div>
    <?php if (count($cart_items) === 0): ?>
      <div class="alert alert-warning text-center">Keranjang Anda kosong.</div>
    <?php else: ?>
    <form method="POST" class="checkout-form">
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
