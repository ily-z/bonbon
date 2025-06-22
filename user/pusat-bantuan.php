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
  <title>Pusat Bantuan | Bonbon Bakery and Cake</title>
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
    .faq-title {
      font-family: 'Sansita Swashed', cursive;
      color: #5a3e2c;
      text-align: center;
      font-size: 2rem;
      margin: 40px 0 10px;
    }
    .accordion-button {
      background-color: #fff2dc;
      color: #5a3e2c;
      font-weight: bold;
    }
    .accordion-button:not(.collapsed) {
      background-color: #e3caa8;
      color: #4d3823;
    }
    .accordion-body {
      background-color: #fffefb;
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

<div class="container mt-5 mb-5">
  <h2 class="faq-title">Pusat Bantuan <i class="bi bi-question-circle"></i></h2>

  <div class="accordion mt-4" id="faqAccordion">
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
          1. Ada berapa macam jenis produk yang dijual di Barley Bakery and Cake?
        </button>
      </h2>
      <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Kami menyediakan aneka roti, kue ulang tahun, kue kering, snack box, dan minuman pilihan. Produk kami bisa disesuaikan dengan kebutuhan acara Anda.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="faq2">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
          2. Apakah ada metode lain selain transfer?
        </button>
      </h2>
      <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Selain metode transfer ke rekening kami, Anda bisa memilih opsi bayar di tempat (COD) untuk pengantaran di wilayah sekitar toko kami.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="faq3">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
          3. Apakah ada perbedaan harga di toko dan harga online?
        </button>
      </h2>
      <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Harga produk di toko dan di website kami sama. Namun, promo khusus online bisa berbeda tergantung periode tertentu.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="faq4">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
          4. Ke rekening mana saya harus mentransfer pembayaran pesanan saya?
        </button>
      </h2>
      <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Nomor rekening kami (BRI/BCA) akan tampil setelah Anda melakukan checkout dan mendapatkan ID Order.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="faq5">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
          5. Berapa biaya ongkos kirim yang harus saya tanggung untuk pengiriman?
        </button>
      </h2>
      <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Ongkos kirim dihitung otomatis berdasarkan jarak pengiriman dan akan terlihat sebelum proses pembayaran.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="faq6">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6">
          6. Bisakah saya mengambil sendiri pesanan saya di toko Barley Bakery and Cake?
        </button>
      </h2>
      <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Tentu saja. Saat checkout, pilih metode pengambilan di toko. Anda bisa datang sesuai jadwal pengambilan yang tertera.
        </div>
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
