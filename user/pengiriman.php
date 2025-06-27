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
  <title>Pengiriman | Bonbon Bakery</title>
  <link rel="shortcut icon" href="../assets/ico/barley.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Sora', sans-serif;
      background-color: #f3e3cd;
    }
    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .content {
      flex: 1;
      padding: 20px;
    }
    .shipping-title {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2.2rem;
      font-weight: bold;
      text-align: center;
      margin: 30px 0;
      color: #333;
    }
    .shipping-table {
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin-bottom: 20px;
    }
    .table-header {
      background-color: #d5ba96;
      color: #000;
      font-weight: bold;
      text-align: center;
      padding: 10px 0;
    }
    .shipping-row {
      transition: all 0.3s ease;
      border-bottom: 1px solid #ddd;
      padding: 15px 20px;
    }
    .shipping-row:last-child {
      border-bottom: none;
    }
    .shipping-row:hover {
      background-color: #f8f9fa;
    }
    .btn-detail {
      background-color: #000;
      color: white;
      border-radius: 20px;
      padding: 6px 15px;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }
    .btn-detail:hover {
      background-color: #333;
      color: white;
    }
    .status-badge {
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.85rem;
      font-weight: 500;
    }
    .status-proses { background-color: #ffd700; }
    .status-dikirim { background-color: #28a745; color: white; }
    .status-selesai { background-color: #6c757d; color: white; }
    /* Footer Styling */
    footer {
      background-color: #222;
      color: #fff;
      padding: 30px 0;
      text-align: center;
    }
    .footer-section {
      display: flex;
      justify-content: space-around;
      margin-top: 20px;
    }
    .footer-column {
      flex: 1;
      text-align: left;
    }
    .footer-column h3 {
      font-family: 'Sansita Swashed', cursive;
      font-size: 1.5rem;
      color: #f3e3cd;
    }
    .footer-column ul {
      list-style: none;
      padding: 0;
    }
    .footer-column li {
      margin-bottom: 10px;
    }
    .footer-column a {
      color: #f3e3cd;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .footer-column a:hover {
      color: #ffd700;
    }
    .social-links {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 20px;
    }
    .social-links a {
      color: #fff;
      font-size: 1.5rem;
      transition: color 0.3s ease;
    }
    .social-links a:hover {
      color: #ffd700;
    }
    .recent-posts img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 10px;
    }
    .recent-posts p {
      font-size: 0.9rem;
      margin: 0;
    }
    .recent-posts span {
      color: #ffd700;
    }
  </style>
</head>
<body>
<div class="wrapper">
  <?php include "navbar.php"; ?>

  <div class="container mt-4 mb-5 content">
    <h2 class="shipping-title">Barang Yang Dikirim <i class="bi bi-truck"></i></h2>

    <?php
    $sql = "SELECT * FROM pengguna 
            INNER JOIN transaksi ON pengguna.id_pengguna = transaksi.id_pengguna
            WHERE pengguna.id_pengguna='$id' AND transaksi.status_transaksi LIKE '%kirim%'
            ORDER BY waktu_transaksi DESC";
    $query = mysqli_query($connect, $sql);
    if (mysqli_num_rows($query) > 0) {
    ?>
    <div class="shipping-table">
      <div class="table-header">
        <div class="row">
          <div class="col-md-2">Tanggal</div>
          <div class="col-md-3">Alamat</div>
          <div class="col-md-2">No Telp</div>
          <div class="col-md-2">Status</div>
          <div class="col-md-3">Aksi</div>
        </div>
      </div>

      <?php
      while($data = mysqli_fetch_array($query)) {
        $status = $data['status_transaksi'];
        $status_class = '';
        $status_text = '';
        
        if ($status == "proses kirim") {
          $status_class = 'status-proses';
          $status_text = 'Proses';
        } else if ($status == "dikirim") {
          $status_class = 'status-dikirim';
          $status_text = 'Dikirim';
        } else if ($status == "selesai") {
          $status_class = 'status-selesai';
          $status_text = 'Selesai';
        }
      ?>
      <div class="shipping-row">
        <div class="row align-items-center">
          <div class="col-md-2"><?php echo date("d-m-Y", strtotime($data['waktu_transaksi'])); ?></div>
          <div class="col-md-3"><?php echo ucwords($data['alamat']); ?></div>
          <div class="col-md-2"><?php echo $data['no_hp']; ?></div>
          <div class="col-md-2 d-flex justify-content-center">
            <span class="status-badge <?php echo $status_class; ?>">
              <?php echo $status_text; ?>
            </span>
          </div>
          <div class="col-md-3 d-flex justify-content-center">
            <a href="detail.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn btn-detail">
              <i class="bi bi-eye"></i> Detail Barang
            </a>
            <?php if($status == "dikirim"){ ?>
              <a href="terima-barang.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn btn-success rounded-pill px-3 ms-2">
                <i class="bi bi-check-circle"></i> Terima
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } else { ?>
      <div class="text-center">
        <img src="../assets/ico/keranjang.png" width="180">
        <h3 class="mt-3">Belum Ada Barang Yang Dikirim</h3>
      </div>
    <?php } ?>
  </div>

  <?php include "footer.php"; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>