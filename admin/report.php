<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] == 'admin'){}else{ ?> <script> alert('Anda Bukan Admin!'); window.location.href='../logout.php' </script> <?php } 
include "../conf/connection.php";
$show='none';
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Barley Bakery and Cake </title>
    <link href="../assets/ico/barley.jpeg" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!-- Datatables core CSS -->
    <link href="../assets/css/datatables.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <span class="navbar-brand">Bonbon Bakery and Cake<span class="glyphicon glyphicon-shopping-cart"></span></span>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="home.php">Beranda</a></li>
                    <li><a href="pengguna.php">Pengguna</a></li>
                    <li ><a href="kategori.php">Kategori</a></li>
                    <li><a href="barang.php">Barang</a></li>
                    <li class="active"><a href="report.php">Laporan</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profil.php"><?php echo ucwords("$nama"); ?></a></li>
                    <li><a href="../logout.php">Keluar</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <br>
    <div class="container">
    <br><br>
       <div class="page-header">
           <h2> Laporan Keuangan </h2>
       </div>
       <div class="container">
           <form action="report.php" method="POST">
          <div class="row">
              <div class="col-lg-3">
              <label for="tglawal" class="form-lable">tanggal awal</label>
              <input type="date" class="form-control" placeholder="tanggal awal" name="tanggalawal">
          </div>
          <div class="col-lg-3">
            <label for="tglakhir" class="form-lable">tanggal akhir</label>
              <input type="date" class="form-control" id="tglakhir" placeholder="tanggal akhir" name="tanggalakhir">
          </div>
                  <button type="submit" class="btn btn-primary mt-4 m-2">lihat laporan Transaksi</button>
              </div>
          </div>
          </form>
       </div>
    </div>
<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
    $tglawal=$_POST['tanggalawal'];
    $tglakhir=$_POST['tanggalakhir'];
    $query="SELECT * FROM transaksi WHERE (status_transaksi= 'lunas') AND (waktu_transaksi BETWEEN '$tglawal' AND '$tglakhir')";
    $result=mysqli_query($connect,$query);
    $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //var_dump($data);
    $show='block';
}
?>
    <div class="container">
      
<div style="display: <?= $show?>">
       <table id="tables" class="table table-responsive table-bordered table-striped">
           <thead>
               <tr>
                   <th style="text-align: center;"> Tanggal  </th>
                   <th style="text-align: center;"> Subtotal </th>
               </tr>
           </thead>
           <?php foreach($data as $dat):?>
                   <tr>
                       <td style="text-align: center;"><?= $dat['waktu_transaksi'] ?></td>
                       <td style="text-align: center;"><?= $dat['subtotal'] ?></td>
                   </tr>
            <?php endforeach;?>
       </table>
    </div>
</div>




	<!--Footer -->
    <div class="col-md-12 end-box ">
         &copy; 2024 | All Rights Reserved | Bonbon Bakery and Cake
    </div>
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
