<?php
session_start();
if (empty($_SESSION['nama'])) {
    echo "<script> window.location.href='../index.php' </script>";
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Keranjang | Bonbon Bakery</title>
  <link rel="shortcut icon" href="../assets/ico/barley.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    * { box-sizing: border-box; }
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Sora', sans-serif;
      background-color: #f3e3cd;
    }
    .wrapper { display: flex; flex-direction: column; min-height: 100vh; }
    .content { flex: 1; }
    .cart-title {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2.2rem;
      font-weight: bold;
      text-align: center;
      margin: 30px 0;
    }
    .cart-table {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 15px 25px;
      margin-bottom: 20px;
    }
    .cart-header {
      background-color: #d5ba96;
      padding: 15px;
      border-radius: 20px;
      margin-bottom: 15px;
      font-weight: bold;
    }
    .cart-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #d5ba96;
      padding: 15px;
      border-radius: 20px;
      margin-bottom: 15px;
    }
    .cart-item {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .cart-item img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 15px;
    }
    .cart-qty button {
      background-color: transparent;
      border: none;
      font-size: 18px;
      font-weight: bold;
      margin: 0 8px;
      cursor: pointer;
    }
    .cart-qty input {
      width: 30px;
      text-align: center;
      border: none;
      background: transparent;
      font-weight: bold;
    }
    .remove-btn {
      color: red;
      font-size: 1.2rem;
      text-decoration: none;
    }
    .remove-btn:hover {
      color: darkred;
    }
    .cart-total {
      text-align: right;
      font-weight: bold;
      font-size: 1.2rem;
    }
    .btn-checkout {
      background-color: #C9AA7B;
      color: white;
      border-radius: 20px;
      font-weight: bold;
      padding: 8px 30px;
    }

    /* Overlay Checkout */
    .checkout-overlay {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(10px);
      z-index: 9999;
      display: none;
      justify-content: center;
      align-items: center;
    }

    .checkout-modal {
      background: #f0c58c;
      padding: 30px;
      border-radius: 25px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
      font-family: 'Sora', sans-serif;
      width: 90%;
      max-width: 400px;
    }

    .checkout-modal input[type="text"] {
      width: 100%;
      margin-bottom: 15px;
      padding: 12px 18px;
      font-size: 0.95rem;
      border: none;
      border-radius: 30px;
    }

    .checkout-modal .btns {
      display: flex;
      justify-content: end;
      gap: 10px;
    }

    .btn-cancel, .btn-submit {
      padding: 6px 20px;
      font-weight: bold;
      font-family: 'Sora', sans-serif;
      border: 1px solid #000;
      border-radius: 18px;
    }

    .btn-submit {
      background-color: #c9aa7b;
      color: white;
      border: none;
    }
  </style>
</head>
<body>
<div class="wrapper">
<?php include "navbar.php"; ?>

<div class="container mt-4 mb-5 content">
  <h2 class="cart-title">Keranjang <i class="bi bi-basket-fill"></i></h2>

  <div class="cart-table">
    <div class="cart-header row text-center">
      <div class="col-md-3">Produk</div>
      <div class="col-md-3">Harga</div>
      <div class="col-md-3">Jumlah</div>
      <div class="col-md-2">Total</div>
      <div class="col-md-1"></div>
    </div>
    <form method="POST" action="checkout.php" id="checkoutForm">
    <?php 
      $sql = "SELECT * FROM barang 
              INNER JOIN keranjang ON barang.id_barang = keranjang.id_barang 
              WHERE keranjang.id_pengguna='$id' AND status='belum bayar'";
      $query = mysqli_query($connect, $sql);
      $total_semua = 0;
      if (mysqli_num_rows($query) > 0) {
        while($data = mysqli_fetch_array($query)) {
          $total_semua += $data['total'];
          echo "<input type='hidden' name='id_keranjang[]' value='{$data['id_keranjang']}'>";
    ?>
    <div class="cart-row">
      <div class="cart-item col-md-3">
        <img src="../images/product/<?php echo $data['gambar']; ?>" alt="produk">
        <div><?php echo ucwords($data['nama_barang']); ?></div>
      </div>
      <div class="col-md-3 text-center">Rp.<?php echo number_format($data['harga_barang']); ?></div>
      <div class="col-md-3 cart-qty text-center">
        <?php if ($data['jumlah_beli'] > 1) { ?>
          <a href="kurangi-keranjang.php?id=<?php echo $data['id_keranjang']; ?>"><button type="button">-</button></a>
        <?php } else { ?>
          <a href="hapus-keranjang.php?id=<?php echo $data['id_keranjang']; ?>" onclick="return confirm('Jumlah hanya 1. Hapus barang dari keranjang?')"><button type="button">-</button></a>
        <?php } ?>
        <input type="text" value="<?php echo $data['jumlah_beli']; ?>" disabled>
        <a href="tambah-keranjang.php?id=<?php echo $data['id_keranjang']; ?>"><button type="button">+</button></a>
      </div>
      <div class="col-md-2 text-center">Rp.<?php echo number_format($data['total']); ?></div>
      <div class="col-md-1 text-center">
        <a href="hapus-keranjang.php?id=<?php echo $data['id_keranjang']; ?>" class="remove-btn"><i class="bi bi-trash-fill"></i></a>
      </div>
    </div>
    <?php } ?>
    <div class="cart-total">Total: <strong>Rp.<?php echo number_format($total_semua); ?></strong></div>
    <div class="text-end mt-3">
      <button type="button" class="btn btn-checkout" onclick="toggleCheckout(true)">Pesan</button>
    </div>
    <?php } else { ?>
      <div class="text-center">
        <img src="../assets/ico/keranjang.png" width="180">
        <h3 class="mt-3">Belum ada barang di keranjang.</h3>
      </div>
    <?php } ?>
    </form>
  </div>
</div>

<!-- Checkout Modal -->
<div class="checkout-overlay" id="checkoutOverlay">
  <form action="checkout.php" method="POST" class="checkout-modal">
    <?php 
      $query2 = mysqli_query($connect, $sql);
      while($item = mysqli_fetch_array($query2)) {
        echo "<input type='hidden' name='id_keranjang[]' value='{$item['id_keranjang']}'>";
      }
    ?>
    <input type="hidden" name="sub" value="<?php echo $total_semua; ?>">
    <input type="text" name="alamat" maxlength="40" placeholder="Masukkan Alamat Anda......" required />
    <input type="text" name="no_hp" maxlength="15" placeholder="Masukkan No telepon anda......" required />
    <div class="btns">
      <button type="button" class="btn-cancel" onclick="toggleCheckout(false)">Batal</button>
      <button type="submit" class="btn-submit">Oke</button>
    </div>
  </form>
</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleCheckout(show) {
  const overlay = document.getElementById('checkoutOverlay');
  overlay.style.display = show ? 'flex' : 'none';
}
</script>
</body>
</html>
