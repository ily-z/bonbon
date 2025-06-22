<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
if($_SESSION['hak'] == 'pengguna'){}else{ ?> <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script> <?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Barley Bakery and Cake </title>
<link href="../assets/ico/barley.jpeg" rel="shorcut icon">
<link href="../assets/css/bootstrap.css" rel="stylesheet">
<?php
	include "../conf/connection.php";
	$id_pengguna = $_SESSION['id'];
	$subtotal = $_POST['sub'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	//get waktu
	//date_default_timezone_set('Asia/Jakarta');
	$waktu = date("y-m-d");

	//update waktu dan status tabel keranjang
	$count = count($_POST['id_keranjang']);
	for($i=0; $i<$count; $i++){
		$a = "update keranjang set waktu='$waktu',status='proses kirim' where id_keranjang='".$_POST["id_keranjang"][$i]."'";
		$b = mysqli_query($connect, $a);
	}

	//insert tabel transaksi
	$c = "insert into transaksi (waktu_transaksi,subtotal,status_transaksi,alamat,no_hp,id_pengguna) values ('$waktu','$subtotal','proses kirim','$alamat','$no_hp','$id_pengguna')";
	$d = mysqli_query($connect, $c);

	if($d){ ?>
		<div class="container my-5 py-5">
  <div class="text-center p-5 rounded" style="background-color: #fff3e0; border: 2px dashed #c9aa7b;">
    <h2 style="font-family: 'Sansita Swashed', cursive; color: #ad8d5c; font-size: 2rem;">
      Barang Anda Akan Segera Dikirim
    </h2>
    <p class="mt-3" style="font-family: 'Sora', sans-serif; font-size: 1.05rem;">
      Pesanan Anda akan segera dikonfirmasi oleh admin.<br>
      Untuk melihat status pengiriman, tekan ikon 
      <i class="bi bi-send-fill text-primary"></i> pada navbar.<br><br>
      Lakukan pembayaran kepada kurir kami saat barang sampai.<br>
      Jika sudah menerima barang, tekan tombol 
      <span class="badge bg-primary">Barang Diterima</span> di menu <strong>Pengiriman</strong>.
    </p>
    <a href="pengiriman.php" class="btn btn-warning btn-lg mt-4 px-4 py-2 fw-bold" style="font-family: 'Sora', sans-serif;">OK</a>
  </div>
</div>
<?php } else {
  echo "<script> alert('Terjadi Kesalahan'); window.location.href='keranjang.php' </script>";
	}
?>