<?php session_start();
if(empty($_SESSION['nama'])){ ?>
  <script> window.location.href='../masuk.php' </script>
<?php }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] != 'pengguna'){ ?>
  <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>
<?php }
include "../conf/connection.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Alamat Toko | Bonbon Bakery and Cake</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../assets/ico/barley.png" rel="shortcut icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sora', sans-serif;
      background-color: #f3e3cd;
      margin: 0;
    }
    .section-title {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2.2rem;
      text-align: center;
      color: #5a3e2c;
      margin: 50px 0 20px;
    }
    .map-container {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
      margin-bottom: 50px;
    }
    .map-frame {
      border: 4px solid #c9aa7b;
      border-radius: 10px;
      width: 100%;
      height: 450px;
    }
    .info-box {
      background-color: #fffdf9;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .info-box i {
      color: #5a3e2c;
      margin-right: 10px;
    }
    .btn-kembali {
      background-color: #c9aa7b;
      color: #fff;
      font-weight: bold;
      border-radius: 8px;
      padding: 10px 30px;
    }
    .btn-kembali:hover {
      background-color: #ad8d5c;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<?php include "navbar.php"; ?>

<!-- MAP CONTENT -->
<div class="container mt-5">
  <h2 class="section-title">Alamat Toko Kami <i class="bi bi-geo-alt-fill"></i></h2>

  <div class="map-container">
    <iframe class="map-frame"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7933.3485510530845!2d106.77934453091572!3d-6.174344560159137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f657fd635a67%3A0xb043411364acf6!2sBarley%20Bakery%20%26%20Cake!5e0!3m2!1sen!2sid!4v1623653302319!5m2!1sen!2sid"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>

    <div class="info-box mt-4">
      <h5><i class="bi bi-shop-window"></i> Barley Bakery & Cake Tanjung</h5>
      <p><i class="bi bi-geo-alt"></i> Jl. Telang No.17, Kamal, Bangkalan</p>
      <p><i class="bi bi-envelope"></i> abcd@gmail.com</p>
      <p><i class="bi bi-telephone"></i> 08xxxxxxxxx</p>
      <p><i class="bi bi-clock"></i> Buka: 08.00 - 21.00 WIB (Setiap Hari)</p>
    </div>

    <div class="text-center mt-4">
      <a href="home.php" class="btn btn-kembali">Kembali ke Beranda</a>
    </div>
  </div>
</div>

<!-- FOOTER -->
<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
