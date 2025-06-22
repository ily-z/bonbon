<?php 
include "resources/headers.php";
 ?>

<body>
  
  <!-- Header -->
 <header class="p-3 bg-dark text-white sticky-top"> 
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Login</button>
          <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
      </div>
    </div>
  </header>

  <!-- Carousel -->

  <div id="myCarousel" class="carousel slide h-50%" data-bs-ride="carousel">
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="images/content/background.jpg" class="d-block w-100 " alt="Slide 1" style="filter:brightness(65%)" >
      <div class="carousel-caption carousel-caption-left d-none d-md-block">
        <h3 style="color: #E9BD8C;" >Bonbon Backery and Cake</h3>
        <h1  class="sansita-swashed-carousel" >Manis di setiap Gigitan</h1>
      <button class="btn mt-3 btl-clr-caroulsel">Pesan Sekarang</button>
      </div>
    </div>

    <div class="carousel-item ">
      <img src="images/carousel/image1.jpg" class="d-block w-100 " alt="Slide 1" style="filter:brightness(65%)" >
      <div class="carousel-caption carousel-caption-left d-none d-md-block">
        <h3 style="color: #E9BD8C;" >Bonbon Backery and Cake</h3>
        <h1  class="sansita-swashed-carousel" >Manis di setiap Gigitan</h1>
      <button class="btn mt-3 btl-clr-caroulsel">Pesan Sekarang</button>
      </div>
    </div>

    <div class="carousel-item">
      <img src="images/carousel/image2.jpg" class="d-block w-100" alt="Slide 2" style="filter:brightness(65%)">
      <div class="carousel-caption carousel-caption-left d-none d-md-block">
      <h3 style="color: #E9BD8C;" >Bonbon Backery and Cake</h3>
        <h1 class="sansita-swashed-carousel" >Second Slide</h1>
        <button class="btn mt-3 btl-clr-caroulsel">Jangan Sampai ketinggalan</button>
      </div>
    </div>

    <div class="carousel-item">
      <img src="images/carousel/image3.jpg" class="d-block w-100" alt="Slide 3" style="filter:brightness(65%)">
      <div class="carousel-caption d-none d-md-block carousel-caption-left">
        <h3 style="color: #E9BD8C;" >Bonbon Backery and Cake</h3>
        <h1 class="sansita-swashed-carousel" >Delightfull!</h1>
        <button class="btn mt-3 btl-clr-caroulsel">Pesan Sekarang</button>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="h-[1px]"></div> <!-- Scroll space -->

  <section 
    class="section-bg h-[500px] flex items-center justify-center relative overflow-hidden text-center"
    x-data="{ show: false }"
    x-intersect.once="show = true"
    style="background-image: url('images/background-table.jpg'); background-size: cover; background-position: center;"
  >
    <!-- Caption -->
    <div class="text-white text-4xl font-bold z-10">
      <h5>Dapatkan 20% untuk pembelian pertama Anda!</h5>
    <p>Gunakan kode promo: <strong>MANIS20</strong> saat checkout.</p>
    <a href="#produk-grid" ><button class="btn btn-dark">Selengkapnya</button></a>
    </div>

    <!-- Left Decoration -->
    <img 
      src="images/animate_scroll/cupcakes.png" 
      width="400"
      alt="Left decoration"
      class="absolute left-0 top-1/2 transform -translate-y-1/2 drop-shadow-xl/50"
      x-show="show"
      x-transition:enter="transition duration-2000 ease-out"
      x-transition:enter-start="-translate-x-full opacity-0"
      x-transition:enter-end="translate-x-10 opacity-100"
    >

    <!-- Right Decoration -->
    <img 
      src="images/animate_scroll/mix-bread.png" 
      width="400"
      alt="Right decoration"
      class="absolute right-0 top-1/2 transform -translate-y-1/2 drop-shadow-xl/50"
      x-show="show"
      x-transition:enter="transition duration-2000 ease-out"
      x-transition:enter-start="translate-x-full opacity-0"
      x-transition:enter-end="-translate-x-10 opacity-100"
    >
  </section>

  <div class="h-[50px]"></div> <!-- More scroll space -->


  
  <!-- Produk Grid -->
  <div class="container py-4" id ="produk-grid">
    <h3 class="products-landing-page text-center mb-3 py-5">Selengkapnya</h3>
    <div class="row g-3">
         
      <div class="row">
        <?php
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 9;
        $offset = ($page - 1) * $limit;
        $produk = mysqli_query($connect, "SELECT * FROM barang LIMIT $offset,$limit");
        while($row = mysqli_fetch_array($produk)) {
        ?>
        <div class="col-md-4">

          <div class="product-box" >
            <img src="images/product/<?php echo $row['gambar']; ?>">
            <h5 class="mt-2"><?php echo ucwords($row['nama_barang']); ?></h5>
            <div class="price-info mb-2">
              <span>Rp <?php echo number_format($row['harga']); ?></span>
              <a href="user/detail-produk.php?id=<?php echo $row['id_barang']; ?>" class="info-link">i</a>
            </div>
            <form method="POST" action="user/simpan-keranjang.php" class="d-flex align-items-center gap-2">
              <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
              <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>">
              <input type="hidden" name="stok" value="<?php echo $row['stok']; ?>">
              <div 
                  x-data="{ jumlah: 1, min: 1, max: <?php echo $row['stok']; ?> }"
                  class="d-flex align-items-center"
                >
                  <!-- Tombol minus -->
                  <button type="button" class="btn btn-sm btn-secondary me-1"
                    @click="if(jumlah > min) jumlah--"
                  >-</button>

                  <!-- Input -->
                  <input 
                    type="number" 
                    name="jumlah" 
                    class="form-control form-control-sm me-1"
                    style="width: 70px; background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.3); color: white;"
                    x-model="jumlah"
                    :min="min"
                    :max="max"
                    required
                  >

                  <!-- Tombol plus -->
                  <button type="button" class="btn btn-sm btn-secondary"
                    @click="if(jumlah < max) jumlah++"
                  >+</button>
                </div>

              <button type="submit" class="product-box-button " style="background-color: #C9AA7B; color: white; font-weight: bold;">Beli</button>
            </form>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>

        
      </div>
    </div>
    

      <template x-for="i in 6" :key="i">
        <div class="col-6 col-md-4">
          <div class="card">
            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Kue">
          </div>
        </div>
      </template>
    </div>
  </div>
  
  <!-- Tentang Kami -->
  <div class="container py-4">
    <div class="bg-light p-4 text-center">
      <h4>Tentang Kami</h4>
      <p>Kami berkomitmen menghadirkan kue terbaik dari bahan pilihan.</p>
      <button class="btn btn-dark">Selengkapnya</button>
    </div>
  </div>
  
  <!-- Rekomendasi -->
  <div class="container py-4">
    <h4 class="text-center mb-3">Rekomendasi Manis</h4>
    <div class="row text-center">
      <div class="col-4">
        <img src="https://via.placeholder.com/150" class="img-fluid rounded" alt="Kue">
        <p>Kue<br>Rp 10.000</p>
      </div>
      <div class="col-4">
        <img src="https://via.placeholder.com/150" class="img-fluid rounded" alt="Donat">
        <p>Kue<br>Rp 5.000</p>
      </div>
      <div class="col-4">
        <img src="https://via.placeholder.com/150" class="img-fluid rounded" alt="Brownies">
        <p>Kue<br>Rp 15.000</p>
      </div>
    </div>
  </div>

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
                        while ($row = mysqli_fetch_array($query1)){ 
                ?>

                    <div class="col-md-4 text-center col-sm-6">
                        <div class="thumbnail">
                            <img src="<?="images/product/$row[gambar]" ?>" width="50%" height="30%">
                            <div class="caption">
                                <h4><?php echo ucwords("$row[nama_barang]"); ?> <span class="badge"><?php echo "$row[stok]"; ?></span></h4>
                                <p style="color: red;">Rp. <?= number_format("$row[harga]") ?> </p>
                            </div>
                        </div>
                    </div>
                    
                <?php 
                    } // end while
                }else{ 
                    ?>

                    <center><img src="assets/ico/kosong.png"><h2>Barang Tidak Tersedia!!</h2></center>
                <?php } ?>
                </div>

            <center>
                
                <div class="row">
                    <ul class="pagination">
                    
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
    
<?php include "resources/footers.php"; ?>


