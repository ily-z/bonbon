<?php include "../conf/connection.php"; ?>
<style>
  body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  main {
    flex: 1;
  }
  footer {
    background: url('../images/content/dark-texture.jpg') center/cover no-repeat;
    color: white;
    padding: 40px 0;
    margin-top: auto;
  }
  footer h5 {
    color: #f4ae44;
  }
  footer a {
    color: white;
    text-decoration: none;
  }
  footer a:hover {
    text-decoration: underline;
  }
  .new-product-footer {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
  }
  .new-product-footer img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 10px;
  }
  .new-product-footer small {
    display: block;
    font-size: 0.8rem;
    color: #ddd;
  }
</style>

<footer>
  <div class="container">
    <div class="text-center mb-4">
      <span>Ikuti Kami</span>
      <div class="d-inline-block ms-2">
        <a href="#" class="me-2 text-white"><i class="bi bi-facebook"></i></a>
        <a href="#" class="me-2 text-white"><i class="bi bi-pinterest"></i></a>
        <a href="#" class="me-2 text-white"><i class="bi bi-whatsapp"></i></a>
        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
      </div>
    </div>
    <hr class="bg-light">
    <div class="row text-start">
      <div class="col-md-4">
        <h5 class="fw-bold">Tentang Kami</h5>
        <p class="mb-0">08xxxxxxxx</p>
        <p class="mb-0">abcd@gmail.com</p>
        <p class="mb-0">Jln Telang</p>
        <p>Kamal, Bangkalan</p>
      </div>
      <div class="col-md-4">
        <h5 class="fw-bold">Jelajahi</h5>
        <p class="mb-0"><a href="#">Beranda</a></p>
        <p class="mb-0"><a href="#">Blog</a></p>
        <p class="mb-0"><a href="#">Kontak Kami</a></p>
        <p><a href="#">Layanan</a></p>
      </div>
      <div class="col-md-4">
        <h5 class="fw-bold">Apa yang Baru?</h5>
        <?php
        $query = mysqli_query($connect, "SELECT id_barang, nama_barang, gambar FROM barang ORDER BY id_barang DESC LIMIT 2");
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
            <a href="detail-produk.php?id=' . $row['id_barang'] . '" class="new-product-footer text-white text-decoration-none">
              <img src="../images/product/' . $row['gambar'] . '" alt="' . htmlspecialchars($row['nama_barang']) . '">
              <div>
                <small>' . date("d M Y") . '</small>
                <strong>' . htmlspecialchars($row['nama_barang']) . '</strong>
              </div>
            </a>
          ';
        }
        ?>
      </div>
    </div>
    <div class="text-center mt-4">
      <small>© 2025 Bonbon Bakery and Cake. Hak Cipta Dilindungi</small>
    </div>
  </div>
</footer>
