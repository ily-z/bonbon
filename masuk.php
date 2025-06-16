<?php session_start(); include "conf/connection.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autentikasi | Bonbon Bakery and Cake</title>
  <link rel="shortcut icon" href="assets/ico/barley.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    body {
      position: relative;
      margin: 0;
      height: 100vh;
      font-family: 'Sora', sans-serif;
    }
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0,0,0,0.4)), url('images/content/background.jpg') center/cover no-repeat;
      z-index: -2;
    }
    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      backdrop-filter: none;
      z-index: -1;
    }
    body, html {
      display: flex;
      justify-content: center;
      align-items: center;
      background: transparent;
    }
    .container-auth {
      width: 800px;
      height: 500px;
      background: transparent;
      border-radius: 30px;
      overflow: hidden;
      display: flex;
      position: relative;
    }
    .form-container {
      position: absolute;
      top: 0;
      height: 100%;
      width: 50%;
      padding: 50px 40px;
      transition: all 0.6s ease-in-out;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(14px);
      color: white;
      border-radius: 30px;
      text-align: center;
    }
    .form-container h2 {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2rem;
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.4);
      color: white;
      border-radius: 25px;
      font-size: 0.95rem;
      padding: 10px 15px;
    }
    select.form-control option {
      background-color: #333;
      color: white;
    }
    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.05);
      color: white;
      border-color: white;
      box-shadow: none;
    }
    .form-control::placeholder {
      color: #eee;
    }
    .form-control[type="date"]::-webkit-calendar-picker-indicator {
      filter: invert(1);
      cursor: pointer;
    }
    .sign-in-container {
      left: 0;
      z-index: 2;
    }
    .sign-up-container {
      left: 0;
      opacity: 0;
      z-index: 1;
    }
    .container-auth.active .sign-up-container {
      transform: translateX(100%);
      opacity: 1;
      z-index: 5;
    }
    .container-auth.active .sign-in-container {
      transform: translateX(100%);
      opacity: 0;
      z-index: 1;
    }
    .overlay-container {
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      height: 100%;
      overflow: hidden;
      transition: transform 0.6s ease-in-out;
      z-index: 100;
    }
    .container-auth.active .overlay-container {
      transform: translateX(-100%);
    }
    .overlay {
      background: linear-gradient(135deg, #E88C00, #F4AE44, #C9AA7B);
      color: white;
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }
    .container-auth.active .overlay {
      transform: translateX(50%);
    }
    .overlay-panel {
      position: absolute;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 0 40px;
      text-align: center;
      top: 0;
      height: 100%;
      width: 50%;
      transition: all 0.6s ease-in-out;
    }
    .overlay-panel img {
      margin-bottom: 5px;
      width: 150px;
    }
    .overlay-panel h3 {
      font-size: 1.5rem;
    }
    .overlay-panel p {
      font-size: 0.9rem;
    }
    .overlay-left {
      transform: translateX(-20%);
    }
    .container-auth.active .overlay-left {
      transform: translateX(0);
    }
    .overlay-right {
      right: 0;
      transform: translateX(0);
    }
    .container-auth.active .overlay-right {
      transform: translateX(20%);
    }
    .btn-outline-light {
      border: 2px solid white;
      color: white;
      font-size: 1rem;
      border-radius: 30px;
      padding: 10px 24px;
    }
    .btn-outline-light:hover {
      background: white;
      color: black;
    }
    .social-icons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 20px;
    }
    .social-icons a {
      font-size: 1.4rem;
      color: white;
      border: 1px solid white;
      border-radius: 50%;
      padding: 8px;
      width: 36px;
      height: 36px;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: background 0.3s;
    }
    .social-icons a:hover {
      background: white;
      color: #C9AA7B;
    }
  </style>
</head>
<body>
<?php
if (isset($_POST['login'])) {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $sql = "SELECT * FROM pengguna WHERE username='$user' AND password='$pass'";
  $query = mysqli_query($connect, $sql);
  $data = mysqli_fetch_array($query);
  $cek = mysqli_num_rows($query);
  $nama = $data['nama'] ?? null;
  $hak = $data['hak'] ?? null;
  $id = $data['id_pengguna'] ?? null;
  if ($cek > 0) {
    $_SESSION['nama'] = $nama;
    $_SESSION['hak'] = $hak;
    $_SESSION['id'] = $id;
    echo "<script>window.location.href='" . ($hak == 'admin' ? 'admin/home.php' : 'user/home.php') . "';</script>";
  } else {
    echo '<div class="alert alert-danger mt-2 position-absolute top-0 start-50 translate-middle-x">Login gagal!</div>';
  }
}

if (isset($_POST['daftar'])) {
  $nama = $_POST['nama'];
  $jk = $_POST['jenis_kelamin'];
  $tgl = $_POST['tgl_lahir'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $sql = "INSERT INTO pengguna(nama,jenis_kelamin,tgl_lahir,username,password,hak) VALUES('$nama','$jk','$tgl','$user','$pass','pengguna')";
  $query = mysqli_query($connect, $sql);
  if ($query) {
    echo "<script>alert('Pendaftaran berhasil, silakan login!');</script>";
  } else {
    echo '<div class="alert alert-danger mt-2 position-absolute top-0 start-50 translate-middle-x">Pendaftaran gagal!</div>';
  }
}
?>

<script>
function toggleForm(toRegister) {
  const container = document.getElementById('authContainer');
  if (toRegister) {
    container.classList.add("active");
  } else {
    container.classList.remove("active");
  }
}
</script>
<div class="container-auth" id="authContainer">
  <div class="form-container sign-in-container">
    <h2 class="mb-4">Masuk</h2>
    <div class="social-icons">
      <a href="#"><i class="bi bi-google"></i></a>
      <a href="#"><i class="bi bi-facebook"></i></a>
    </div>
    <form method="POST">
      <input type="text" name="user" class="form-control mb-3" placeholder="Username" required>
      <input type="password" name="pass" class="form-control mb-3" placeholder="Kata Sandi" required>
      <button class="btn w-100" style="background-color: #C9AA7B; color: white; border-radius: 30px; font-size: 1.1rem; padding: 10px;" name="login">Masuk</button>
    </form>
  </div>
  <div class="form-container sign-up-container">
    <h2 class="mb-4">Daftar</h2>
    <div class="social-icons">
      <a href="#"><i class="bi bi-google"></i></a>
      <a href="#"><i class="bi bi-facebook"></i></a>
    </div>
    <form method="POST">
      <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
      <select name="jenis_kelamin" class="form-control mb-2" required>
        <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
        <option value="Laki - Laki">Laki - Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      <input type="date" name="tgl_lahir" class="form-control mb-2" required>
      <input type="text" name="user" class="form-control mb-2" placeholder="Username" required>
      <input type="password" name="pass" class="form-control mb-2" placeholder="Kata Sandi" required>
      <button class="btn w-100" style="background-color: #C9AA7B; color: white; border-radius: 30px; font-size: 1.1rem; padding: 10px;" name="daftar">Daftar</button>
    </form>
  </div>
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
        <img src="assets/ico/barley.png" alt="Logo" width="200" class="mb-3">
        <h3 class="fw-bold" style="font-family: 'Sansita Swashed', cursive;">Selamat Datang</h3>
        <p>Masukkan data pribadi Anda dan ciptakan momen manis bersama toko kue kami!</p>
        <button class="btn btn-outline-light mt-3" onclick="toggleForm(false)">MASUK</button>
      </div>
      <div class="overlay-panel overlay-right">
        <img src="assets/ico/barley.png" alt="Logo" width="200" class="mb-3">
        <h3 class="fw-bold" style="font-family: 'Sansita Swashed', cursive;">Selamat Datang</h3>
        <p>Yuk, login dan nikmati berbagai sajian manis yang sudah menantimu!</p>
        <button class="btn btn-outline-light mt-3" onclick="toggleForm(true)">DAFTAR</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
