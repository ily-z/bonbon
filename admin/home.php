<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] == 'admin'){}else{ ?> <script> alert('Anda Bukan Admin!'); window.location.href='../logout.php' </script> <?php } 
include "../conf/connection.php";
include "admin-navbar.php";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bonbon Bakery and Cake </title>
    <link href="../assets/ico/barley.jpeg" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Datatables core CSS -->
    <link href="../assets/css/datatables.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>
    
<div class="container mt-40">
   <br><br><br><br>
   <div class="page-header">
   	<h2> Daftar Order </h2>
   </div>
   <table id="tables" class="table table-responsive table-bordered table-striped">
   	<thead>
   		<tr>
   			<th style="text-align: center;"> Nama </th>
   			<th style="text-align: center;"> Tanggal </th>
   			<th style="text-align: center;"> Alamat Pengiriman</th>
   			<th style="text-align: center;"> No Telepon </th>
   			<th style="text-align: center;"> Status </th>
   			<th style="text-align: center;"> Aksi </th>
   		</tr>
   	</thead>
   	<?php
   		$sql = "select * from pengguna inner join transaksi on pengguna.id_pengguna = transaksi.id_pengguna";
   		$query = mysqli_query($connect, $sql);
   		while ($data = mysqli_fetch_array($query)){ $status = $data['status_transaksi']; ?>
   			<tr>
   				<td><?php echo ucwords("$data[nama]"); ?></td>
   				<td><?php echo ucwords("$data[waktu_transaksi]"); ?></td>
   				<td><?php echo ucwords("$data[alamat]"); ?></td>
   				<td><?php echo ucwords("$data[no_hp]"); ?></td>
   				<td>
	   				 <?php if($status == 'diproses'){ ?>
	   					Menunggu Konfirmasi
	   				 <?php }else if($status == 'dikirim'){ ?> 
	   				 	Barang Dikirim 
	   				 <?php }else if($status == 'selesai'){ ?> 
	   				 	Lunas
	   				 <?php } ?>
   				</td>
   				<td style="text-align: center;">
   				 <?php if($status == 'diproses'){ ?>
   					<a href="lihat-barang.php?id_transaksi=<?php echo "$data[id_transaksi]"; ?>" class="btn btn-primary">Lihat Barang</a>
   				 <?php }else if($status == 'dikirim'){ ?> 
   				 	<a href="lihat-barang.php?id_transaksi=<?php echo "$data[id_transaksi]"; ?>" class="btn btn-success">Lihat Barang</a>
   				 <?php }else if($status == 'selesai'){ ?> 
   				 	<a href="lihat-barang.php?id_transaksi=<?php echo "$data[id_transaksi]"; ?>" class="btn btn-warning">Lihat Barang</a>
   				 <?php } ?>
   				</td>
   			</tr>
   		<?php }
   	?>
   </table>
</div>

  <!-- <center><a href="cetak-order.php" class="btn btn-success" target="_BLANK">Cetak</a></center> -->


    <!--Footer -->
   <?php 
   include "admin-footer.php";
   ?>
    <!-- /.col -->
    <!--Footer end -->
    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
    <script>
        $(document).ready(function () {
          $('#tables').DataTable();
          $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
