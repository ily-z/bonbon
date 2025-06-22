<?php 
session_start();
if(empty($_SESSION['nama'])) {
  echo "<script>window.location.href='../masuk.php'</script>"; exit;
}
if($_SESSION['hak'] != 'pengguna') {
  echo "<script>alert('Anda Bukan Pengguna!'); window.location.href='../logout.php'</script>"; exit;
}
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];

include "../conf/connection.php";
$id_transaksi = $_GET['id_transaksi'];

// Ambil data transaksi
$trans = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
$dataTrans = mysqli_fetch_array($trans);
$waktu_transaksi = $dataTrans['waktu_transaksi'];
$subtotal = $dataTrans['subtotal'];
$alamat = $dataTrans['alamat'];
$no_hp = $dataTrans['no_hp'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Pengiriman | Bonbon Bakery</title>
  <link rel="shortcut icon" href="../assets/ico/barley.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sora', sans-serif;
      background-color: #f3e3cd;
    }
    .section-title {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2rem;
      margin: 30px 0 10px;
      text-align: center;
    }
    .info-pengiriman {
      text-align: center;
      font-size: 1.05rem;
      margin-bottom: 25px;
    }
    .info-pengiriman div {
      margin: 4px 0;
    }
    .product-box {
      background: url('../images/content/dark-texture-produk.png') center/cover no-repeat;
      color: white;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 20px;
      text-align: center;
      position: relative;
      height: 100%;
    }
    .product-box img {
      width: 95%;
      height: 140px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 8px;
    }
    .price-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 0.9rem;
      margin-bottom: 4px;
      padding: 0 5px;
    }
    .info-link {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      background: transparent;
      color: white;
      border: 1px solid white;
      border-radius: 50%;
      width: 22px;
      height: 22px;
      text-decoration: none;
      font-size: 0.8rem;
      font-weight: bold;
    }
    .nama-produk {
      font-size: 0.95rem;
      margin-bottom: 5px;
    }
    .qty-box {
      background-color: white;
      color: black;
      font-weight: bold;
      width: 28px;
      height: 28px;
      line-height: 28px;
      border-radius: 6px;
      margin: 0 auto;
      font-size: 0.9rem;
    }
    .total-harga {
      text-align: right;
      font-weight: bold;
      font-size: 1.2rem;
      margin-top: 30px;
    }
    .kembali-btn {
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>
<?php include "navbar.php"; ?>

<div class="container mt-4 mb-5">
  <h2 class="section-title">Detail Barang</h2>
  <div class="text-center fw-bold text-muted mb-3" style="font-style: italic;">Sedang dikirim</div>

  <div class="info-pengiriman">
    <div><strong>Tanggal</strong> : <?php echo date("d-m-Y", strtotime($waktu_transaksi)); ?></div>
    <div><strong>Alamat</strong> : <?php echo $alamat; ?></div>
    <div><strong>No Telepon</strong> : <?php echo $no_hp; ?></div>
  </div>

  <div class="row justify-content-center">
    <?php 
      // Ambil semua data berdasarkan id_transaksi
      $sql = "SELECT * FROM barang 
              INNER JOIN keranjang ON barang.id_barang = keranjang.id_barang 
              WHERE keranjang.id_transaksi = '$id_transaksi'";

      $query = mysqli_query($connect, $sql);
      $produk = [];

      // Gabung berdasarkan id_barang
      while($data = mysqli_fetch_array($query)){
        $idb = $data['id_barang'];
        if(!isset($produk[$idb])) {
          $produk[$idb] = [
            'id_barang' => $idb,
            'nama_barang' => $data['nama_barang'],
            'gambar' => $data['gambar'],
            'harga' => $data['harga'],
            'jumlah' => $data['jumlah_beli'],
          ];
        } else {
          $produk[$idb]['jumlah'] += $data['jumlah_beli'];
        }
      }

      // Tampilkan
      foreach($produk as $item){ ?>
        <div class="col-6 col-md-3 col-sm-4 d-flex">
          <div class="product-box w-100">
            <img src="../images/product/<?php echo $item['gambar']; ?>" alt="<?php echo $item['nama_barang']; ?>">
            <div class="price-info">
              <span>Rp <?php echo number_format($item['harga']); ?></span>
              <a href="detail-produk.php?id=<?php echo $item['id_barang']; ?>" class="info-link">i</a>
            </div>
            <div class="nama-produk"><?php echo ucwords($item['nama_barang']); ?></div>
            <div class="qty-box"><?php echo $item['jumlah']; ?></div>
          </div>
        </div>
    <?php } ?>
  </div>

  <div class="total-harga">Total : Rp.<?php echo number_format($subtotal); ?></div>

  <div class="kembali-btn">
    <a href="pengiriman.php" class="btn btn-warning mt-3 px-4 py-2 fw-bold" style="border-radius: 25px;">Kembali</a>
  </div>
</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
