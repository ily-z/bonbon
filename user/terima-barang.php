<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../masuk.php' </script>
<?php } 
if($_SESSION['hak'] == 'pengguna'){}else{ ?> <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script> <?php }
	include "../conf/connection.php";
	$id_pengguna = $_SESSION['id'];
	$id_transaksi = $_GET['id_transaksi'];
	//get waktu
	date_default_timezone_set('Asia/Jakarta');
	$waktu = date('l, d-m-Y h:i:sa');

	//tampilkan transaksi
	$a = "select * from transaksi where id_transaksi='$id_transaksi'";
	$b = mysqli_query($connect, $a);
	$c = mysqli_fetch_array($b);
	//get waktu transaksi
	$waktu_transaksi = $c['waktu_transaksi'];

	//update transaksi
	$d = "update transaksi set status_transaksi='lunas',waktu_transaksi='$waktu' where id_transaksi='$id_transaksi'";
	$e = mysqli_query($connect, $d);
	
	//update data tabel keranjang
	$f = "update keranjang set status='lunas',waktu='$waktu' where waktu='$waktu_transaksi' and id_pengguna='$id_pengguna'";
	$g = mysqli_query($connect, $f);

	if($g){
		echo "<script> alert('Terimakasih Sudah Belanja Di Store Kami'); window.location.href='riwayat.php' </script>";
	}else{
		echo "<script> alert('Terjadi Kesalahan'); window.location.href='riwayat.php' </script>";
	}
?>