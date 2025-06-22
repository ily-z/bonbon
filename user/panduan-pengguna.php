<?php session_start();
if(empty($_SESSION['nama'])){ ?>
  <script> window.location.href='../masuk.php' </script>
<?php }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] != 'pengguna'){ ?>
  <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>
<?php } ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Panduan Pengguna | Bonbon Bakery and Cake</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../assets/ico/barley.png" rel="shortcut icon">
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
      margin: 30px 0 20px 0;
      color: #5a3e2c;
      text-align: center;
    }
    .step-box {
      text-align: center;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      margin-bottom: 25px;
    }
    .step-box i {
      font-size: 3rem;
      color: #5a3e2c;
      margin-bottom: 10px;
    }
    .btn-kembali {
      background-color: #C9AA7B;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      padding: 10px 30px;
    }
    .btn-kembali:hover {
      background-color: #AD8D5C;
      color: #fff;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<?php include "navbar.php"; ?>

<!-- ISI PANDUAN -->
<div class="container mt-5 mb-5">
  <h2 class="section-title">Panduan Pengguna <i class="bi bi-journal-check"></i></h2>

  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-3">
      <div class="step-box">
        <i class="bi bi-person-circle"></i>
        <h5 class="mt-2">Daftar & Login</h5>
        <p>Buat akun terlebih dahulu sebelum memesan produk dari kami.</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="step-box">
        <i class="bi bi-bag-check"></i>
        <h5 class="mt-2">Cek Produk</h5>
        <p>Telusuri dan tambahkan produk ke keranjang jika tertarik.</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="step-box">
        <i class="bi bi-wallet2"></i>
        <h5 class="mt-2">Selesaikan Pembayaran</h5>
        <p>Gunakan ID Order & transfer ke rekening kami yang tersedia.</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="step-box">
        <i class="bi bi-truck"></i>
        <h5 class="mt-2">Cek Status</h5>
        <p>Lacak status pemesanan di menu Riwayat atau Order Anda.</p>
      </div>
    </div>
  </div>

  <div class="text-center mt-4">
    <a href="home.php" class="btn btn-kembali">Kembali</a>
  </div>
</div>

<!-- FOOTER -->
<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
