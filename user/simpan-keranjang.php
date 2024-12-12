<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
if($_SESSION['hak'] == 'pengguna'){}else{ ?> <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script> <?php }
include "../conf/connection.php";
	$id = $_SESSION['id'];
	$harga = $_POST['harga'];
	$jumlah = $_POST['jumlah'];
	$id_barang = $_POST['id_barang'];
	$stok = $_POST['stok'];
	$total = $harga * $jumlah;
	$total_stok = $stok - $jumlah;
if($stok < $jumlah){
	echo "<script> alert('Maaf Stok Tidak Mencukupi'); window.location.href='home.php' </script>";
}else{
	//update stok barang
	$a = "update barang set stok='$total_stok' where id_barang='$id_barang'";
	$b = mysqli_query($connect, $a);

	//insert keranjang
	$sql = "insert into keranjang (harga_barang,jumlah_beli,status,total,id_barang,id_pengguna) values ('$harga','$jumlah','belum bayar','$total','$id_barang','$id')";
	$query = mysqli_query($connect, $sql);

	if($query){
		echo "<script> alert('Barang Sudah Dimasukkan Ke Keranjang'); window.location.href='keranjang.php' </script>";
	}else{
		echo "<script> alert('Terjadi Kesalahan'); window.location.href='home.php' </script>";
	}
}
?>