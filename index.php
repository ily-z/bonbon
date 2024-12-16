<?php 
include "conf/connection.php";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bonbon Bakery and Cake </title>
    <link href="assets/ico/barley.jpeg" rel="shortcut icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
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

                </button>
                <span class="navbar-brand">Bonbon Bakery and Cake<span class="glyphicon glyphicon-shopping-cart"></span></span>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Beranda</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="masuk.php">Masuk</a></li>
                    <li><a href="daftar.php">Daftar</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<br><br><br><br>
    <div class="container">
      
        <div class="row">

            <div class="col-md-9">
                    
              <div class="jumbotron">
                  <h1> Bonbon Bakery and Cake <img src="assets/ico/barley.jpeg" width="15%" height="15%"></h1>
                  <p>
                    Belanja kue impian anda secara online, aman dan nyaman di Bonbon Bakery and Cake.
                  </p><br><br><br>
                  <p>
                    <a href="#" onclick="$('#get').animatescroll({scrollSpeed:2000,easing:'easeOutBack'});" class="btn btn-primary btn-lg">Mulai</a>
                  </p>
                  <div id="get"></div>
                </div><hr>
              <div class="row">
                <?php
                    $page = (isset($_GET['page']))? $_GET['page'] : 1;
                    $limit = 9;
                    $limit_start = ($page - 1) * $limit;
                    $sql1 = "select * from barang LIMIT $limit_start, $limit";
                    $query1 = mysqli_query($connect,$sql1);
                    $cek = mysqli_num_rows($query1);
                    if($cek > 0){
                    while ($row = mysqli_fetch_array($query1)){ ?>
                    <div class="col-md-4 text-center col-sm-6">
                        <div class="thumbnail">
                            <img src="<?php echo "images/product/$row[gambar]"; ?>" width="50%" height="30%">
                            <div class="caption">
                                <h4><?php echo ucwords("$row[nama_barang]"); ?> <span class="badge"><?php echo "$row[stok]"; ?></span></h4>
                                <p style="color: red;">Rp. <?php echo number_format("$row[harga]") ?> </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php }
                }else{ ?>
                    <center><img src="assets/ico/kosong.png"><h2>Barang Tidak Tersedia!!</h2></center>
                <?php } ?>
                </div>

            <center>
                <!-- /.row -->
                <div class="row">
                    <ul class="pagination">
                    <!-- LINK NUMBER -->
                    <?php
                    // Buat query untuk menghitung semua jumlah data
                    $q2 = "select * from barang";
                    $sql2 = mysqli_query($connect, $q2); // Eksekusi querynya
                    $get_jumlah = mysqli_num_rows($sql2);
                    
                    $jumlah_page = ceil($get_jumlah / $limit); // Hitung jumlah halamannya
                    $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                    $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                    $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
                    
                    for($i = $start_number; $i <= $end_number; $i++){
                      $link_active = ($page == $i)? ' class="active"' : '';
                    ?>
                      <li<?php echo $link_active; ?>><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                   ?>
                    </ul>
                </div>
                <!-- /.row -->
            </center>
            <!-- /.col -->
        </div>

            <div class="col-md-3">
                <div>
                    <a class="list-group-item active ">Pencarian
                    </a>
                    <ul class="list-group">

                        <li class="list-group-item">
                            <form  action="search.php" method="POST">
                                <div class="col-md-9">
                                <input type="text" name="cari" class="form-control" placeholder="Telusuri.."><br>
                                </div>
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a class="list-group-item active">Kategori
                    </a>
                    <ul class="list-group">
                        <?php
                        include "conf/connection.php";
                        $sql = "select * from kategori";
                        $query = mysqli_query($connect,$sql);
                        while ($data = mysqli_fetch_array($query)){ ?>
                            <li class="list-group-item"><a href="kategori.php?kategori=<?php echo "$data[id_kategori]"; ?>"><?php echo "$data[kategori]"; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a class="list-group-item active">Tentang
                    </a>
                    <ul class="list-group">
                            <li class="list-group-item"><a href="pusat-bantuan.php">Pusat Bantuan</a></li>
                            <li class="list-group-item"><a href="maps.php">Maps</a></li>
                            <li class="list-group-item"><a href="panduan-pengguna.php">Panduan Pengguna</a></li>
                    </ul>
                </div>

                <div>
                    <a class="list-group-item active">Produk Baru
                    </a>
                    <ul class="list-group">
                        <?php
                            $a = "select * from barang order by id_barang desc limit 2";
                            $b = mysqli_query($connect,$a);
                            while ($c = mysqli_fetch_array($b)){ ?>
                            <li class="list-group-item">
                                <div class="thumbnaill">
                                    <div class="captionn">
                                        <h4><?php echo "$c[nama_barang]"; ?> <span class="badge"><?php echo "$c[stok]"; ?></span></h4>
                                        <p>Rp. <?php echo "$c[harga]" ?> </p>
                                    </div>
                                    <center><img src="<?php echo "images/product/$c[gambar]"; ?>" width="70%" height="40%"/></center>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.div -->
              
            </div>
            <!-- /.col -->

            </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    
    <!--Footer -->
    <div class="col-md-12 end-box ">
         &copy; 2024 | All Rights Reserved | Bonbon Bakery and Cake
    </div>

    <!-- /.col -->
    <!--Footer end -->
    <!--jQUERY FILES-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- ANIMATE SCROLL -->
    <script src="assets/js/animatescroll.js"></script>
    <!-- HOVER IMAGE EFFECT -->
    <script src="assets/js/hover.image.effect.js"></script>
</body>
</html>