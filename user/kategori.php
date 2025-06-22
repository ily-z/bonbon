<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../masuk.php' </script>
<?php }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] != 'pengguna'){ ?>
    <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>
<?php } 
include "../conf/connection.php";

// Ambil nama kategori
$kategori = $_GET['kategori'];
$query_kategori = mysqli_query($connect, "SELECT kategori FROM kategori WHERE id_kategori='$kategori'");
$nama_kategori = mysqli_fetch_array($query_kategori)['kategori'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kategori <?php echo $nama_kategori; ?> | Bonbon Bakery and Cake</title>
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
    .navbar {
      background-color: #C9AA7B;
    }
    .navbar-brand, .nav-link, .navbar-text {
      color: white !important;
      font-weight: bold;
    }
    .sidebar {
      background-color: #AD8D5C;
      padding: 20px;
      border-radius: 10px;
      color: white;
      margin-bottom: 20px;
    }
    .sidebar h5 {
      margin-top: 20px;
      font-weight: bold;
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      padding-bottom: 5px;
      font-family: 'Sansita Swashed', cursive;
      font-size: 1.3rem;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      margin-bottom: 8px;
    }
    .sidebar a:hover {
      text-decoration: underline;
    }
    .product-box {
      background: url('../images/content/dark-texture-produk.png') center/cover no-repeat;
      color: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      position: relative;
    }
    .product-box img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
    }
    .product-box button {
      background-color: #C9AA7B;
      border: none;
      padding: 8px 12px;
      color: white;
      font-weight: bold;
      border-radius: 5px;
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 1;
    }
    .product-box form {
      position: relative;
    }
    .product-box .form-control[type=number] {
      width: 80px;
      margin-bottom: 10px;
    }
    .price-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .info-link {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      background: transparent;
      color: white;
      border: 1px solid white;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: bold;
    }
    .form-control[type=number] {
      background-color: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.3);
      color: white;
    }
    .form-control[type=number]::placeholder {
      color: white;
    }
    .form-control[type=number]:focus {
      background-color: rgba(255,255,255,0.1);
      color: white;
    }
    .pagination {
      justify-content: center;
    }
    .pagination .page-link {
      color: #C9AA7B;
      font-weight: bold;
    }
    .pagination .active .page-link {
      background-color: #C9AA7B;
      border-color: #C9AA7B;
      color: white;
    }
    .section-title {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2rem;
      margin: 30px 0;
    }
    .new-product {
      display: flex;
      align-items: center;
      background: rgba(255,255,255,0.1);
      padding: 10px;
      border-radius: 10px;
      margin-bottom: 10px;
      transition: all 0.3s ease;
    }
    .new-product:hover {
      background: rgba(255,255,255,0.2);
      transform: translateX(5px);
    }
    .new-product img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 10px;
    }
    .new-product .info {
      flex-grow: 1;
    }
    .new-product .info span {
      display: block;
      font-size: 0.9rem;
      margin-bottom: 3px;
    }
    .new-product .info strong {
      display: block;
      font-size: 0.85rem;
    }
    .new-product a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-4">
  <h2 class="text-center section-title" style="font-family: 'Sansita Swashed', cursive; font-size: 2rem; margin: 30px 0;">
    Kategori <?php echo htmlspecialchars($nama_kategori); ?> <i class="bi bi-cake2-fill text-warning"></i>
  </h2>
  <div class="row">
    <div class="col-md-3">
      <div class="sidebar" style="background-color: #AD8D5C; padding: 20px; border-radius: 10px; color: white;">
        <form action="search.php" method="GET" class="mb-3">
          <input type="text" name="cari" class="form-control" placeholder="Cari produk...">
        </form>
        <h5 style="margin-top: 20px; font-weight: bold; border-bottom: 1px solid rgba(255, 255, 255, 0.3); padding-bottom: 5px; font-family: 'Sansita Swashed', cursive; font-size: 1.3rem;">Kategori</h5>
        <ul class="list-unstyled">
        <?php $sql = "select * from kategori";
              $query = mysqli_query($connect,$sql);
              while ($data = mysqli_fetch_array($query)){
                echo "<li><a href='kategori.php?kategori={$data['id_kategori']}' class='text-white text-decoration-none d-block mb-2'>".htmlspecialchars($data['kategori'])."</a></li>";
              } ?>
        </ul>
        <h5 class="mt-4" style="font-family: 'Sansita Swashed', cursive; font-size: 1.3rem;">Tentang</h5>
        <ul class="list-unstyled">
          <li><a href="costumer-service.php" class="text-white text-decoration-none d-block mb-2">Layanan Pelanggan</a></li>
          <li><a href="pusat-bantuan.php" class="text-white text-decoration-none d-block mb-2">Pusat Bantuan</a></li>
          <li><a href="maps.php" class="text-white text-decoration-none d-block mb-2">Maps</a></li>
          <li><a href="panduan-pengguna.php" class="text-white text-decoration-none d-block mb-2">Panduan Pengguna</a></li>
        </ul>
        <h5 class="mt-4" style="font-family: 'Sansita Swashed', cursive; font-size: 1.3rem;">Produk Baru</h5>
        <?php
        $new = mysqli_query($connect, "SELECT * FROM barang ORDER BY id_barang DESC LIMIT 2");
        while($item = mysqli_fetch_array($new)) {
          echo "<a href='detail-produk.php?id={$item['id_barang']}' class='new-product d-flex align-items-center text-white text-decoration-none mb-3' style='background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;'>
                  <img src='../images/product/{$item['gambar']}' alt='{$item['nama_barang']}' style='width: 60px; height: 60px; object-fit: cover; border-radius: 50%; margin-right: 10px;'>
                  <div>
                    <div>{$item['nama_barang']}</div>
                    <strong>Rp ".number_format($item['harga'])."</strong>
                  </div>
                </a>";
        }
        ?>
      </div>
    </div>
    <div class="col-md-9">
      <div class="row">
        <?php
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 9;
        $offset = ($page - 1) * $limit;
        $produk = mysqli_query($connect, "SELECT * FROM barang WHERE id_kategori='$kategori' LIMIT $offset,$limit");
        if(mysqli_num_rows($produk) > 0) {
          while($row = mysqli_fetch_array($produk)) {
        ?>
        <div class="col-md-4">
          <div class="product-box">
            <img src="../images/product/<?php echo $row['gambar']; ?>">
            <h5 class="mt-2"><?php echo ucwords($row['nama_barang']); ?></h5>
            <div class="price-info mb-2">
              <span>Rp <?php echo number_format($row['harga']); ?></span>
              <a href="detail-produk.php?id=<?php echo $row['id_barang']; ?>" class="info-link">i</a>
            </div>
            <form method="POST" action="simpan-keranjang.php" class="d-flex align-items-center gap-2 mt-auto">
              <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
              <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>">
              <input type="hidden" name="stok" value="<?php echo $row['stok']; ?>">
              <input type="number" name="jumlah" class="form-control form-control-sm me-2"
                     style="width: 70px; background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.3); color: white;"
                     value="1" min="1" max="<?php echo $row['stok']; ?>" required>
              <button type="submit" class="btn btn-sm" style="background-color: #C9AA7B; color: white; font-weight: bold;">Beli</button>
            </form>
          </div>
        </div>
        <?php }} else { echo "<div class='text-center'><h4>Produk tidak ditemukan!</h4></div>"; } ?>
      </div>

      <!-- Custom Pagination -->
      <nav class="mt-4">
        <ul class="pagination justify-content-center">
          <?php
          $total = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM barang WHERE id_kategori='$kategori'"));
          $pages = ceil($total / $limit);
          $show = 3; // Tampilkan hanya 3 page
          $start = max(1, $page - 1);
          $end = min($pages, $start + $show - 1);

          if ($start > 1) {
            echo "<li class='page-item'><a class='page-link' href='kategori.php?kategori=$kategori&page=".($start - 1)."'><<</a></li>";
          }

          for ($i = $start; $i <= $end; $i++) {
            $active = ($i == $page) ? 'active' : '';
            echo "<li class='page-item $active'><a class='page-link' href='kategori.php?kategori=$kategori&page=$i'>$i</a></li>";
          }

          if ($end < $pages) {
            echo "<li class='page-item'><a class='page-link' href='kategori.php?kategori=$kategori&page=".($end + 1)."'>>></a></li>";
          }
          ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
