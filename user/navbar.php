<?php
// Pastikan session sudah dimulai sebelum include file ini
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<style>
  body {
    padding-top: 76px; /* Menambahkan padding-top untuk mengkompensasi fixed navbar */
  }
  .navbar {
    background-color: #C9AA7B;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1030;
  }
  .navbar-brand,
  .nav-link,
  .navbar-text {
    color: white !important;
    font-weight: bold;
  }
  .navbar-brand {
    font-family: 'Sansita Swashed', cursive;
    font-size: 1.5rem;
  }
  .navbar-brand img {
    margin-right: 10px;
  }
  .navbar-nav .nav-link:hover {
    text-decoration: underline;
    color: #fff !important;
  }
  .profile-icon {
    font-size: 1.5rem;
    display: flex;
    align-items: center;
  }
  .profile-icon:hover {
    text-decoration: none !important;
  }
  .nav-icons {
    display: flex;
    align-items: center;
    gap: 15px;
  }
  .nav-icons .nav-link {
    padding: 0.5rem;
  }
  .nav-icons .nav-link:hover {
    background-color: rgba(255,255,255,0.1);
    border-radius: 50%;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="home.php">
      <img src="../assets/ico/barley.png" width="40" class="me-2"> Bombon Bakery
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="home.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
        <li class="nav-item"><a class="nav-link" href="pengiriman.php">Pengiriman</a></li>
        <li class="nav-item"><a class="nav-link" href="riwayat.php">Riwayat</a></li>
      </ul>
      <ul class="navbar-nav nav-icons">
        <li class="nav-item">
          <a class="nav-link profile-icon" href="profil.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo ucwords($_SESSION['nama'] ?? 'Pengguna'); ?>">
            <i class="bi bi-person-circle"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Keluar">
            <i class="bi bi-box-arrow-right" style="font-size: 1.5rem;"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
});
</script>
