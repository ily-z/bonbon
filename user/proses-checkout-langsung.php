<?php 
session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../masuk.php' </script>
<?php }
if($_SESSION['hak'] != 'pengguna'){ ?>
    <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>
<?php }
include "../conf/connection.php";

$id_pengguna = $_SESSION['id'];
$subtotal = $_POST['sub'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$waktu = date("Y-m-d");

// Simpan transaksi
$insert = "INSERT INTO transaksi (waktu_transaksi, subtotal, status_transaksi, alamat, no_hp, id_pengguna) 
           VALUES ('$waktu', '$subtotal', 'proses kirim', '$alamat', '$no_hp', '$id_pengguna')";
$sukses = mysqli_query($connect, $insert);

// Ambil ID transaksi yang baru saja disimpan
$id_transaksi_baru = mysqli_insert_id($connect);

// Ambil detail barang dari keranjang sebelum dihapus
if (isset($_POST['id_keranjang'])) {
    for($i=0; $i<count($_POST['id_keranjang']); $i++){
        $id_keranjang = $_POST['id_keranjang'][$i];
        // Ambil data barang dari keranjang
        $q = mysqli_query($connect, "SELECT k.*, b.nama_barang, b.gambar, b.harga FROM keranjang k JOIN barang b ON k.id_barang = b.id_barang WHERE k.id_keranjang='$id_keranjang'");
        if($row = mysqli_fetch_assoc($q)) {
            $id_barang = $row['id_barang'];
            $nama_barang = mysqli_real_escape_string($connect, $row['nama_barang']);
            $gambar = mysqli_real_escape_string($connect, $row['gambar']);
            $harga = $row['harga'];
            $jumlah = $row['jumlah_beli'];
            // Insert ke detail_transaksi
            $ins_detail = "INSERT INTO detail_transaksi (id_transaksi, id_barang, nama_barang, gambar, harga, jumlah) VALUES ('$id_transaksi_baru', '$id_barang', '$nama_barang', '$gambar', '$harga', '$jumlah')";
            mysqli_query($connect, $ins_detail);
        }
        // Update status terlebih dahulu untuk menyimpan data transaksi
        $update = "UPDATE keranjang SET waktu='$waktu', status='proses kirim', id_transaksi='$id_transaksi_baru' WHERE id_keranjang='$id_keranjang'";
        mysqli_query($connect, $update);
        // HAPUS item dari keranjang setelah checkout berhasil
        $delete = "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang'";
        mysqli_query($connect, $delete);
    }
}

if (!$sukses) {
    $_SESSION['toast'] = ['msg' => 'Terjadi kesalahan saat melakukan checkout.', 'type' => 'error'];
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Sukses | Bonbon Bakery</title>
  <link rel="shortcut icon" href="../assets/ico/barley.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f3e3cd;
      font-family: 'Sora', sans-serif;
    }
    .success-card {
      background-color: #fff3e0;
      border: 2px dashed #c9aa7b;
      padding: 50px;
      margin: 100px auto;
      max-width: 700px;
      border-radius: 20px;
      text-align: center;
    }
    .success-card h2 {
      font-family: 'Sansita Swashed', cursive;
      color: #ad8d5c;
      font-size: 2rem;
    }
    .success-card p {
      font-size: 1.1rem;
      margin-top: 20px;
    }
    .btn-ok {
      background-color: #c9aa7b;
      color: white;
      font-weight: bold;
      font-family: 'Sora', sans-serif;
      padding: 10px 30px;
      font-size: 1rem;
      border-radius: 30px;
      margin-top: 30px;
    }
  </style>
</head>
<body>
<?php include "navbar.php"; ?>
<?php if ($sukses) { ?>
  <div class="container">
    <div class="success-card shadow-lg">
      <h2><i class="bi bi-check-circle-fill text-success"></i> Pembelian Langsung Berhasil!</h2>
      <p>
        Pesanan Anda telah berhasil dikonfirmasi.<br>
        Silakan cek status pengiriman melalui menu 
        <i class="bi bi-send-fill text-primary"></i> <strong>Pengiriman</strong> pada navbar.<br><br>
        Lakukan pembayaran saat barang diterima kepada kurir kami.<br>
        Setelah barang diterima, klik tombol 
        <span class="badge bg-primary">Barang Diterima</span> di halaman pengiriman.
      </p>
      <a href="pengiriman.php" class="btn btn-ok">OK</a>
    </div>
  </div>
<?php } else { ?>
  <script>
    alert("Terjadi kesalahan saat melakukan checkout.");
    window.location.href = "home.php";
  </script>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 