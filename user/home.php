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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda | Bonbon Bakery and Cake</title>
  <link rel="shortcut icon" href="../assets/ico/barley.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      border-radius: 15px;
      padding: 20px;
      margin-bottom: 25px;
      position: relative;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      border: 1px solid rgba(255,255,255,0.1);
      animation: fadeInUp 0.6s ease-out;
    }
    
    .product-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.25);
      border-color: rgba(255,255,255,0.2);
    }
    
    .product-box img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 15px;
      transition: all 0.3s ease;
    }
    
    .product-box:hover img {
      transform: scale(1.02);
    }
    
    .product-box h5 {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: #fff;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }
    
    .price-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 15px;
      padding: 8px 12px;
      background: rgba(255,255,255,0.1);
      border-radius: 8px;
      backdrop-filter: blur(10px);
    }
    
    .price-info span {
      font-size: 1.1rem;
      font-weight: bold;
      color: #FFD700;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }
    
    .info-link {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #C9AA7B, #AD8D5C);
      color: white;
      border: none;
      border-radius: 50%;
      width: 28px;
      height: 28px;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: bold;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    
    .info-link:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      color: white;
    }
    
    .product-actions {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    
    .action-form {
      display: flex;
      align-items: center;
      gap: 8px;
      background: rgba(255,255,255,0.08);
      padding: 12px;
      border-radius: 10px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.1);
      transition: all 0.3s ease;
    }
    
    .action-form:hover {
      background: rgba(255,255,255,0.12);
      border-color: rgba(255,255,255,0.2);
    }
    
    .quantity-input {
      width: 60px !important;
      background: rgba(255,255,255,0.15) !important;
      border: 2px solid rgba(255,255,255,0.2) !important;
      color: white !important;
      border-radius: 8px !important;
      text-align: center !important;
      font-weight: bold !important;
      transition: all 0.3s ease !important;
    }
    
    .quantity-input:focus {
      background: rgba(255,255,255,0.2) !important;
      border-color: #C9AA7B !important;
      box-shadow: 0 0 0 3px rgba(201, 170, 123, 0.2) !important;
      outline: none !important;
    }
    
    .btn-cart {
      background: linear-gradient(135deg, #AD8D5C, #8B7355);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 8px 16px;
      font-weight: 600;
      font-size: 0.85rem;
      transition: all 0.3s ease;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
      flex: 1;
      position: relative;
      overflow: hidden;
    }
    
    .btn-cart::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .btn-cart:hover::before {
      left: 100%;
    }
    
    .btn-cart:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      background: linear-gradient(135deg, #B89A6A, #9A7F5F);
    }
    
    .btn-buy {
      background: linear-gradient(135deg, #C9AA7B, #A8906A);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 8px 16px;
      font-weight: 600;
      font-size: 0.85rem;
      transition: all 0.3s ease;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
      flex: 1;
      position: relative;
      overflow: hidden;
    }
    
    .btn-buy::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .btn-buy:hover::before {
      left: 100%;
    }
    
    .btn-buy:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      background: linear-gradient(135deg, #D4B88A, #B89A6A);
    }
    
    .stock-out {
      background: rgba(220, 53, 69, 0.2);
      color: #ff6b6b;
      padding: 12px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      border: 1px solid rgba(220, 53, 69, 0.3);
      backdrop-filter: blur(10px);
    }
    
    /* Animasi loading untuk tombol */
    .btn-loading {
      position: relative;
      pointer-events: none;
    }
    
    .btn-loading::after {
      content: '';
      position: absolute;
      width: 16px;
      height: 16px;
      margin: auto;
      border: 2px solid transparent;
      border-top-color: #ffffff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    
    @keyframes spin {
      0% { transform: translate(-50%, -50%) rotate(0deg); }
      100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    /* Efek ripple untuk tombol */
    .btn-ripple {
      position: relative;
      overflow: hidden;
    }
    
    .btn-ripple::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }
    
    .btn-ripple:active::after {
      width: 300px;
      height: 300px;
    }
    
    /* Animasi fade in untuk card */
    .product-box {
      animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Stagger animation untuk multiple cards */
    .col-md-4:nth-child(1) .product-box { animation-delay: 0.1s; }
    .col-md-4:nth-child(2) .product-box { animation-delay: 0.2s; }
    .col-md-4:nth-child(3) .product-box { animation-delay: 0.3s; }
    .col-md-4:nth-child(4) .product-box { animation-delay: 0.4s; }
    .col-md-4:nth-child(5) .product-box { animation-delay: 0.5s; }
    .col-md-4:nth-child(6) .product-box { animation-delay: 0.6s; }
    
    /* Hover effect untuk quantity input */
    .quantity-input:hover {
      background: rgba(255,255,255,0.25) !important;
      border-color: rgba(255,255,255,0.4) !important;
    }
    
    /* Custom scrollbar untuk quantity input */
    .quantity-input::-webkit-inner-spin-button,
    .quantity-input::-webkit-outer-spin-button {
      opacity: 1;
      background: rgba(255,255,255,0.1);
      border-radius: 4px;
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
      .product-box {
        margin-bottom: 20px;
        padding: 15px;
      }
      
      .product-box img {
        height: 160px;
      }
      
      .action-form {
        flex-direction: column;
        gap: 10px;
      }
      
      .quantity-input {
        width: 100% !important;
        margin-bottom: 8px;
      }
      
      .btn-cart, .btn-buy {
        width: 100%;
        padding: 10px;
      }
      
      .price-info {
        flex-direction: column;
        gap: 8px;
        text-align: center;
      }
    }
    
    /* Focus states untuk accessibility */
    .btn-cart:focus, .btn-buy:focus {
      outline: 3px solid rgba(255,255,255,0.5);
      outline-offset: 2px;
    }
    
    .quantity-input:focus {
      outline: 3px solid rgba(201, 170, 123, 0.5);
      outline-offset: 2px;
    }
    
    /* Smooth transitions untuk semua elemen */
    * {
      transition: all 0.2s ease;
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
    .footer {
      background: #222;
      color: #fff;
      padding: 20px 0;
      text-align: center;
    }
  </style>
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-4">
  <h2 class="text-center section-title" style="font-family: 'Sansita Swashed', cursive; font-size: 2rem; margin: 30px 0;">Spesial untuk Anda</h2>
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
        $produk = mysqli_query($connect, "SELECT * FROM barang LIMIT $offset,$limit");
        while($row = mysqli_fetch_array($produk)) {
        ?>
        <div class="col-md-4">
          <div class="product-box">
            <img src="../images/product/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_barang']; ?>">
            <h5><?php echo ucwords($row['nama_barang']); ?></h5>
            <div class="price-info">
              <span>Rp <?php echo number_format($row['harga']); ?></span>
              <a href="detail-produk.php?id=<?php echo $row['id_barang']; ?>" class="info-link" title="Lihat Detail">
                <i class="bi bi-info-circle"></i>
              </a>
            </div>
            <?php if ($row['stok'] > 0): ?>
              <div class="product-actions">
                <div class="d-flex align-items-center justify-content-between gap-2 action-form" style="background:rgba(255,255,255,0.08);border-radius:10px;">
                  <input type="number" class="quantity-input jumlah-barang-input" value="1" min="1" max="<?php echo $row['stok']; ?>" style="width:60px;">
                  <form method="POST" action="simpan-keranjang.php" class="m-0 p-0">
                    <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
                    <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>">
                    <input type="hidden" name="stok" value="<?php echo $row['stok']; ?>">
                    <input type="hidden" name="jumlah" class="jumlah-barang" value="1">
                    <button type="submit" class="btn-cart btn-ripple d-flex align-items-center justify-content-center" title="Tambah ke Keranjang" style="padding:8px 12px;"><i class="bi bi-cart-plus fs-5"></i></button>
                  </form>
                  <form method="POST" action="beli-langsung.php" class="m-0 p-0">
                    <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
                    <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>">
                    <input type="hidden" name="stok" value="<?php echo $row['stok']; ?>">
                    <input type="hidden" name="jumlah" class="jumlah-barang" value="1">
                    <button type="submit" class="btn-buy btn-ripple d-flex align-items-center justify-content-center" title="Beli" style="padding:8px 18px;"><i class="bi bi-lightning-fill fs-5"></i> <span class="ms-1">Beli</span></button>
                  </form>
                </div>
              </div>
            <?php else: ?>
              <div class="stock-out">
                <i class="bi bi-exclamation-triangle me-2"></i>Stok Habis
              </div>
            <?php endif; ?>
          </div>
        </div>
        <?php } ?>
      </div>

      <!-- Custom Pagination -->
      <nav class="mt-4">
        <ul class="pagination justify-content-center">
          <?php
          $total = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM barang"));
          $pages = ceil($total / $limit);
          $show = 3; // Tampilkan hanya 3 page
          $start = max(1, $page - 1);
          $end = min($pages, $start + $show - 1);

          if ($start > 1) {
            echo "<li class='page-item'><a class='page-link' href='home.php?page=".($start - 1)."'><<</a></li>";
          }

          for ($i = $start; $i <= $end; $i++) {
            $active = ($i == $page) ? 'active' : '';
            echo "<li class='page-item $active'><a class='page-link' href='home.php?page=$i'>$i</a></li>";
          }

          if ($end < $pages) {
            echo "<li class='page-item'><a class='page-link' href='home.php?page=".($end + 1)."'>>></a></li>";
          }
          ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Loading state untuk tombol
document.addEventListener('DOMContentLoaded', function() {
  const forms = document.querySelectorAll('.action-form');
  
  forms.forEach(form => {
    form.addEventListener('submit', function(e) {
      const button = form.querySelector('button[type="submit"]');
      const originalText = button.innerHTML;
      
      // Tambahkan loading state
      button.classList.add('btn-loading');
      button.innerHTML = '';
      button.disabled = true;
      
      // Simulasi loading (akan dihapus saat form benar-benar submit)
      setTimeout(() => {
        button.classList.remove('btn-loading');
        button.innerHTML = originalText;
        button.disabled = false;
      }, 2000);
    });
  });
  
  // Efek hover untuk card
  const productBoxes = document.querySelectorAll('.product-box');
  productBoxes.forEach(box => {
    box.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-8px) scale(1.02)';
    });
    
    box.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
    });
  });
  
  // Validasi quantity input
  const quantityInputs = document.querySelectorAll('.quantity-input');
  quantityInputs.forEach(input => {
    input.addEventListener('change', function() {
      const value = parseInt(this.value);
      const max = parseInt(this.getAttribute('max'));
      const min = parseInt(this.getAttribute('min'));
      
      if (value > max) {
        this.value = max;
        showNotification('Jumlah melebihi stok yang tersedia', 'warning');
      } else if (value < min) {
        this.value = min;
        showNotification('Jumlah minimal adalah 1', 'warning');
      }
    });
  });
  
  // Sinkronisasi input jumlah dengan hidden input di kedua form
  document.querySelectorAll('.product-box').forEach(function(box) {
    const inputJumlah = box.querySelector('.jumlah-barang-input');
    const hiddenInputs = box.querySelectorAll('input.jumlah-barang');
    if (inputJumlah && hiddenInputs.length) {
      inputJumlah.addEventListener('input', function() {
        hiddenInputs.forEach(function(h) {
          h.value = inputJumlah.value;
        });
      });
    }
  });
});

// Fungsi untuk menampilkan notifikasi
function showNotification(message, type = 'info') {
  const notification = document.createElement('div');
  notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
  notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
  notification.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  `;
  
  document.body.appendChild(notification);
  
  // Auto remove setelah 3 detik
  setTimeout(() => {
    if (notification.parentNode) {
      notification.remove();
    }
  }, 3000);
}

// Efek ripple untuk tombol
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('btn-ripple')) {
    const ripple = document.createElement('span');
    const rect = e.target.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
      position: absolute;
      width: ${size}px;
      height: ${size}px;
      left: ${x}px;
      top: ${y}px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      transform: scale(0);
      animation: ripple 0.6s linear;
      pointer-events: none;
    `;
    
    e.target.appendChild(ripple);
    
    setTimeout(() => {
      ripple.remove();
    }, 600);
  }
});

// Tambahkan CSS untuk animasi ripple
const style = document.createElement('style');
style.textContent = `
  @keyframes ripple {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }
`;
document.head.appendChild(style);
</script>
</body>
</html>
