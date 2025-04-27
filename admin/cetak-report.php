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
    <script>
        function printAndGoBack() {
            // Trigger the print dialog
            window.print();

            // Go back to the previous page after printing
            window.onafterprint = function() {
                window.history.back();
            };
        }
    </script>
</head>
<body onload="printAndGoBack()">
<?php 
    $tglawal=$_GET['tanggalawal'];
    $tglakhir=$_GET['tanggalakhir'];
    $query="SELECT waktu_transaksi,subtotal FROM transaksi WHERE (status_transaksi= 'lunas') AND (waktu_transaksi BETWEEN '$tglawal' AND '$tglakhir')";
    $result=mysqli_query($connect,$query);
    $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //var_dump($data);
    $tabeldata=totalByDay( bindingarr($result));
?>
    
    <br>
    <div class="container">
    <br><br>
       <div class="page-header">
           <h2> Laporan Keuangan </h2>
       </div>
       <h4>antara tanggal <?= $tglawal?>  sampai <?= $tglakhir?></h4>
    </div>

    <div class="container">
<div >
    <div class="d-flex justify-content-center">
    <div class="w-65 p-3" width="60%"> 
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
            animation:false,
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

</div>

<?php 
// echo "<script>window.print()</script>";
// header('location:http://localhost:80/bonbon/admin/report.php');
?>

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
        // $(document).ready(function () {
        //   $('#tables').DataTable();
        //   $('.dataTables_length').addClass('bs-select');
        // });
    </script>
    
</body>
</html>
