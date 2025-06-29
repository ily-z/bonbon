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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Riwayat | Bonbon Bakery</title>
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
    .riwayat-title {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2.2rem;
      font-weight: bold;
      text-align: center;
      margin: 30px 0;
    }
    .riwayat-header, .riwayat-row {
      background-color: #d5ba96;
      padding: 15px;
      border-radius: 20px;
      margin-bottom: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: bold;
    }
    .riwayat-row {
      font-weight: normal;
    }
    .riwayat-row .btn {
      border-radius: 20px;
      padding: 5px 12px;
      font-size: 0.9rem;
    }
    .btn-detail {
      background-color: #ffffff;
      border: 1px solid #ccc;
    }
    .btn-print {
      background-color: transparent;
      border: none;
      font-size: 1.2rem;
    }
    .no-data {
      text-align: center;
      margin-top: 50px;
    }
  </style>
</head>
<body>
<div class="wrapper">
<?php include "navbar.php"; ?>
<div class="coba-blur">

  <div class="container mt-4 mb-5 content">
    <h2 class="riwayat-title">Riwayat <i class="bi bi-clock-history"></i></h2>
  
    <div class="riwayat-header">
      <div style="width: 20%;">Tanggal</div>
      <div style="width: 20%;">Alamat</div>
      <div style="width: 20%;">No Telp</div>
      <div style="width: 20%;">Total</div>
      <div style="width: 20%; text-align: center;">Aksi</div>
      <div style="width: 20%; text-align: center;">Cetak</div>
    </div>
  
    <?php
      $sql = "SELECT * FROM pengguna 
              INNER JOIN transaksi ON pengguna.id_pengguna = transaksi.id_pengguna
              WHERE pengguna.id_pengguna='$id' AND transaksi.status_transaksi='lunas'
              ORDER BY waktu_transaksi DESC";
      $query = mysqli_query($connect, $sql);
      if (mysqli_num_rows($query) > 0) {
        while($data = mysqli_fetch_array($query)) {
    ?>
    <div class="riwayat-row">
      <div style="width: 20%;"><?php echo date("d-m-Y", strtotime($data['waktu_transaksi'])); ?></div>
      <div style="width: 20%;"><?php echo ucwords($data['alamat']); ?></div>
      <div style="width: 20%;"><?php echo $data['no_hp']; ?></div>
      <div style="width: 20%;">Rp.<?php echo number_format($data['subtotal']); ?></div>
      <div style="width: 20%; text-align: center;">
        <a href="detail-riwayat.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn btn-detail">Detail Barang</a>
      </div>
      <div style="width: 20%; text-align: center;">
      <a href="print.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" target="_BLANK" class="btn-print"><i class="bi bi-printer-fill"></i></a>
      </div>
      
    </div>
    <?php }} else { ?>
      <div class="no-data">
        <img src="../assets/ico/keranjang.png" width="180"><br>
        <h4 class="mt-3">Belum ada riwayat transaksi.</h4>
      </div>
    <?php } ?>
  </div>
  
  <?php include "footer.php"; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
