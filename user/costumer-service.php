<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../masuk.php' </script>
<?php }
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
if($_SESSION['hak'] == 'pengguna'){}else{ ?> <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script> <?php }
include "../conf/connection.php";
 ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pelanggan | Bonbon Bakery and Cake</title>
    <link rel="shortcut icon" href="../assets/ico/barley.png">
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
      .section-title {
        font-family: 'Sansita Swashed', cursive;
        font-size: 2rem;
        margin: 30px 0 20px 0;
        color: #C9AA7B;
        text-align: center;
      }
      .form-box {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        padding: 32px 24px;
        margin-top: 30px;
      }
      .btn-kirim {
        background-color: #C9AA7B;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        padding: 10px 30px;
      }
      .btn-kirim:hover {
        background-color: #AD8D5C;
        color: #fff;
      }
    </style>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-4 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="section-title">Layanan Pelanggan <img src="../assets/ico/cs.png" width="40" height="40"></h2>
 <?php 
error_reporting(0);
      $simpan = $_POST['simpan'];
  ?>
      <div class="form-box">
            <form method="post" action="costumer-service.php">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama ..." required>
                  </div>
                  <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email ..." required>
                  </div>
                  <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan yang Dialami</label>
            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" placeholder="Tuliskan keluhan yang dialami ..." required></textarea>
                  </div>
          <div class="mb-3">
            <label for="notelp" class="form-label">No. Telp Aktif</label>
            <input type="text" class="form-control" id="notelp" name="notelp" placeholder="Masukkan No. HP ..." required>
                  </div>
          <div class="text-end">
            <button type="submit" name="simpan" class="btn btn-kirim">Kirim</button>
            <a href="home.php" class="btn btn-secondary ms-2">Kembali</a>
          </div>
        </form>
      </div>
      <?php if ($simpan) { ?>
      <script type="text/javascript">
        alert ("Data Berhasil Disimpan, Terimakasih Telah Mengisi Form Layanan Pelanggan Barley Bakery And Cake. Kami akan mengirimkan respon ke alamat email yang telah dimasukkan");
        window.location.href="costumer-service.php";
      </script>
      <?php } ?>
            </div>
        </div>
          </div>
<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>