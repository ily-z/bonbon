<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] == 'admin'){}else{ ?> <script> alert('Anda Bukan Admin!'); window.location.href='../logout.php' </script> <?php } 
include "../conf/connection.php";
$show='none';

function bindingarr($arr){
    $result=[];
    foreach($arr as $data){
        $result[$data['waktu_transaksi']]=$data['subtotal'];
    }
    return $result;
}

function totalByDay($array){
    $result=[];
    foreach($array as $datkey => $data){
        if(! array_key_exists($datkey,$result)){
            $result[$datkey]=$data;
        }else{
            $result[$datkey]+=$data;
        }
    }
    return $result;

}

function ambiltangal($array){
    $result=[];
    foreach($array as $key=> $data){
        $result[]=$key;
    }
    return $result;
}
function ambiltotal($array){
    $result=[];
    foreach($array as $key => $data){
        $result[]=$data;
    }
    return $result;
}

function ambiltotalsemua($array){
    $transaksi=count($array);
    $total=0;
    foreach($array as $data){
        $total += $data['subtotal'];
    }
    return [$transaksi,$total];

}
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
              <input type="date" class="form-control" placeholder="tanggal awal" name="tanggalawal" value="<?php if(isset($_POST['tanggalawal'])){ echo $_POST['tanggalawal'];}?>">
          </div>
          <div class="col-lg-3">
            <label for="tglakhir" class="form-lable">tanggal akhir</label>
              <input type="date" class="form-control" id="tglakhir" placeholder="tanggal akhir" name="tanggalakhir" value="<?php if(isset($_POST['tanggalakhir'])){ echo $_POST['tanggalakhir'];}?>">
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
    $query="SELECT waktu_transaksi,subtotal FROM transaksi WHERE (status_transaksi= 'lunas') AND (waktu_transaksi BETWEEN '$tglawal' AND '$tglakhir')";
    $result=mysqli_query($connect,$query);
    $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //var_dump($data);
    $tabeldata=totalByDay( bindingarr($result));
    $show='block';
    if(!isset($_SESSION['tglawal'],$_SESSION['tglakhir'])){
        $_SESSION['tglawal']=$tglawal;
        $_SESSION['tglakhir']=$tglakhir;
    }
}

if(isset($_SESSION['tglawal'],$_SESSION['tglakhir'])){
    $_POST['tanggalawal']=$_SESSION['tglawal'];
    $_POST['tanggalakhir']=$_SESSION['tglakhir'];

}
?>
    <div class="container">
<div style="display: <?= $show?>">
    <div class="d-flex justify-content-center">
    
    <div class="w-65 p-3 ">
        
        <div>
        <canvas id="myChart"></canvas>
        </div>
    
        <script>
        const ctx = document.getElementById('myChart');
    
        new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode( ambiltangal($tabeldata))?>,
            datasets: [{
            label: 'pendapatan',
            data: <?= json_encode( ambiltotal($tabeldata))?>,
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
        });
    </script>
    
    </div>
    </div>

       <table id="tables" class="table table-responsive table-bordered table-striped">
           <thead>
               <tr>
                   <th style="text-align: center;"> Tanggal  </th>
                   <th style="text-align: center;"> total perhari </th>
               </tr>
           </thead>
           <?php foreach($tabeldata as $key =>$dat):?>
                   <tr>
                       <td style="text-align: center;"><?= $key ?></td>
                       <td style="text-align: center;"><?= $dat ?></td>
                   </tr>
            <?php endforeach;?>
       </table>

       <table id="tables" class="table table-responsive table-bordered table-striped">
           <thead>
               <tr>
                   <th style="text-align: center;"> total transaksi </th>
                   <th style="text-align: center;"> total pendapatan </th>
               </tr>
           </thead>
           <tr>
               <td style="text-align: center;"><?= ambiltotalsemua($data)[0]?></td>
               <td style="text-align: center;"><?= ambiltotalsemua($data)[1] ?></td>
           </tr>
       </table>
    </div>

    <div>
        <form action="cetak-report.php" method="get">
            <input type="hidden" value="<?= $tglawal?>" name="tanggalawal">
            <input type="hidden" value="<?= $tglakhir?>" name="tanggalakhir">
            <button type="submit" class="btn btn-primary">Cetak Report</button>
        </form>
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
