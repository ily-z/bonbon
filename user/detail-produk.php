<?php
session_start();
if (empty($_SESSION['nama'])) {
    echo "<script> window.location.href='../masuk.php' </script>";
    exit;
}
$nama = $_SESSION['nama'];
if ($_SESSION['hak'] != 'pengguna') {
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>";
    exit;
}
include "../conf/connection.php";

$id = $_GET['id'] ?? 0;
$query = mysqli_query($connect, "SELECT b.*, k.kategori FROM barang b LEFT JOIN kategori k ON b.id_kategori = k.id_kategori WHERE id_barang = '$id'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "<script>alert('Produk tidak ditemukan!');window.location.href='home.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk | Bonbon Bakery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sora', sans-serif;
      background-color: #f3e3cd;
      margin: 0;
      padding: 0;
    }
    .container-detail {
      min-height: 100vh;
      background-color: #f3e3cd;
      padding: 50px 20px;
      display: flex;
      align-items: center;
    }
    .product-img {
      width: 100%;
      border-radius: 10px;
      object-fit: cover;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .btn-kurang, .btn-tambah {
      background-color: transparent;
      border: 1px solid #000;
      width: 35px;
      height: 35px;
      font-weight: bold;
      transition: all 0.3s ease;
    }
    .btn-kurang:hover, .btn-tambah:hover {
      background-color: #C9AA7B;
      color: white;
      border-color: #C9AA7B;
    }
    .input-jumlah {
      width: 50px;
      text-align: center;
      border: none;
      background-color: transparent;
      font-weight: bold;
    }
    .btn-beli {
      background-color: #C9AA7B;
      color: white;
      font-weight: bold;
      border-radius: 20px;
      padding: 8px 25px;
      border: none;
      transition: all 0.3s ease;
    }
    .btn-beli:hover {
      background-color: #AD8D5C;
      transform: translateY(-2px);
    }
    .rating-stars {
      color: gold;
      font-size: 1.3rem;
    }
    .product-info {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .product-info h3 {
      font-family: 'Sansita Swashed', cursive;
      color: #C9AA7B;
    }
    .product-info .price {
      font-size: 1.5rem;
      color: #C9AA7B;
      font-weight: bold;
    }
    .product-info .category {
      color: #666;
      font-size: 0.9rem;
    }
    .product-info .description {
      color: #444;
      line-height: 1.6;
    }
  </style>
</head>
<body>

<?php include "navbar.php"; ?>

<main>
<div class="container container-detail">
  <div class="row align-items-center w-100">
    <div class="col-md-4">
      <img src="../images/product/<?php echo $data['gambar']; ?>" class="product-img">
    </div>
    <div class="col-md-8">
      <div class="product-info">
        <h3 class="mb-3"><?php echo $data['nama_barang']; ?></h3>
        <p class="category mb-2">Kategori <?php echo $data['kategori']; ?></p>
        <div class="rating-stars mb-3">
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star-fill"></i>
          <i class="bi bi-star"></i>
        </div>
        <h4 class="price mb-3">Rp <?php echo number_format($data['harga']); ?></h4>
        <p class="description mb-4"><?php echo $data['deskripsi']; ?></p>
        <form method="POST" action="simpan-keranjang.php" class="d-flex align-items-center gap-2">
          <button type="button" class="btn btn-kurang" onclick="ubahJumlah(-1)">-</button>
          <input type="number" name="jumlah" id="jumlah" class="input-jumlah" value="1" min="1" max="<?php echo $data['stok']; ?>">
          <button type="button" class="btn btn-tambah" onclick="ubahJumlah(1)">+</button>
          <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
          <input type="hidden" name="harga" value="<?php echo $data['harga']; ?>">
          <input type="hidden" name="stok" value="<?php echo $data['stok']; ?>">
          <button type="submit" class="btn btn-beli">Tambah Keranjang</button>
        </form>
      </div>
    </div>
  </div>
</div>
</main>

<?php include "footer.php"; ?>
<script>
function ubahJumlah(change) {
  const jumlahInput = document.getElementById('jumlah');
  let current = parseInt(jumlahInput.value);
  const min = parseInt(jumlahInput.min);
  const max = parseInt(jumlahInput.max);
  if (!isNaN(current)) {
    let newVal = current + change;
    if (newVal >= min && newVal <= max) {
      jumlahInput.value = newVal;
    }
  }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>