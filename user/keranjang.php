<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
if($_SESSION['hak'] == 'pengguna'){}else{ ?> <script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script> <?php }
include "../conf/connection.php";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bonbon Bakery and Cake </title>
    <link href="../assets/ico/barley.jpeg" rel="shortcut icon">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <style>
        .flat{
            border-radius: 0px;
        }
    </style>
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
                    <li><a href="member.php">Member</a></li>
                    <li class="active"><a href="keranjang.php" title="Keranjang Belanja"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>  
                    <li><a href="pengiriman.php" title="Pengiriman"><span class="glyphicon glyphicon-send"></span></a></li>
                    <li><a href="riwayat.php" title="Riwayat Transaksi"><span class="glyphicon glyphicon-list-alt"></span></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profil.php"><?php echo ucwords("$nama"); ?></a></li>
                    <li><a href="../logout.php">Keluar</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <br><br>
<div class="container">
    <div class="page-header">
        <h1>Keranjang <span class="glyphicon glyphicon-shopping-cart"></span></h1>
    </div>
    <div class="row">
    <form action="checkout.php" method="POST">
        <?php 
            $sql = "select * from barang inner join keranjang on barang.id_barang = keranjang.id_barang where keranjang.id_pengguna='$id' and status='belum bayar'";
            $query = mysqli_query($connect, $sql);
            $cek = mysqli_num_rows($query);
            if($cek > 0){
                while($data = mysqli_fetch_array($query)){ ?>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail">
                        <img src="../images/product/<?php echo "$data[gambar]"; ?>" width="50%" height="30%">
                        <div class="caption">
                            <h4 align="center"><?php echo ucwords("$data[nama_barang]"); ?></h4><hr>
                            <p>Jumlah Barang : <?php echo "$data[jumlah_beli]"; ?></p>
                            <p>Harga Barang : Rp. <?php echo number_format("$data[harga_barang]"); ?></p>
                            <p>Total : Rp. <?php echo number_format("$data[total]"); ?></p>
                            <center><a href="kurangi-keranjang.php?id=<?php echo "$data[id_keranjang]" ?>" onclick="return confirm('Anda Yakin?')" class="btn btn-danger">Hapus Barang</a></center>
                            <input type="hidden" name="id_keranjang[]" value="<?php echo "$data[id_keranjang]"; ?>">
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            <?php } ?>
    </div>
        <?php
            $a = "select SUM(total) as subtotal from keranjang where id_pengguna='$id' and status='belum bayar'";
            $b = mysqli_query($connect, $a);
            $c = mysqli_fetch_array($b);
            $total_semua = $c['subtotal'];
         ?>
        <h3 align="center"> Total Keseluruhan : Rp. <?php echo number_format($total_semua) ; ?> </h3>
        <center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Checkout</button></center>
        <div id="myModal" class="modal fade" role="dialog">
           <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                        <input type="hidden" name="sub" value="<?php echo $total_semua; ?>">
                        <input type="text" name="alamat" maxlength="40" class="form-control" placeholder="Masukkan Alamat Anda.." required/> <br>
                        <input type="text" name="no_hp" maxlength="15" class="form-control" placeholder="Masukkan No Telepon Anda.." required/>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Batal</a>
                        <input type="submit" class="btn btn-primary" value="OK">
                    </form>
                </div>
            </div>
        </div>
    </div>
        <?php }else{ ?>
            <center><img src="../assets/ico/kosong.png"><h2>Belum Ada Barang Di Keranjang</center>
        <?php } ?>
</div>
<div class="register">
        <div class="container">
            <div class="register-home">
                <p>
                    <a href="home.php" class="btn btn-primary btn=lg">Kembali</a>
                </p>
            </div>
        </div><br>
    <!--Footer -->
   
    <div class="col-md-12 end-box">
        &copy; 2024 | All Rights Reserved | Bonbon Bakery and Cake
    </div>

    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>