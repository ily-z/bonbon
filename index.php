<?php 
include "resources/headers.php";
 ?>

<body>
  
  <!-- Header -->
 <header class="p-3 bg-dark text-white sticky-top"> 
    <div class="container">
       
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <img src="assets/ico/barley.png" width="40" class="me-2">
        <a class="navbar-brand" href="#">
       Bombon Bakery
    </a>
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 mx-2">
          
          <li><a href="#promo-section" class="nav-link px-3 text-white">Promo</a></li>
          <li><a href="#produk-grid" class="nav-link px-3 text-white">Our products</a></li>
          <li><a href="#rekomendasi" class="nav-link px-3 text-white">Recomended</a></li>
          <li><a href="#tentang-kami" class="nav-link px-3 text-white">About</a></li>
        </ul>

        <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form> -->

        <div class="text-end">
          <a href="masuk.php"><button type="button" class="btn btn-outline-light me-2">masuk</button></a>
          <!-- <a href="masuk.php#authContainer><button type="button" class="btn btn-warning">Sign-up</button> </a> -->
           
          
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
      <a href="#produk-grid"><button class="btn mt-3 btl-clr-caroulsel">Pesan Sekarang</button></a>
      
      </div>
    </div>

    <div class="carousel-item ">
      <img src="images/carousel/image1.jpg" class="d-block w-100 " alt="Slide 1" style="filter:brightness(65%)" >
      <div class="carousel-caption carousel-caption-left d-none d-md-block">
        <h3 style="color: #E9BD8C;" >Bonbon Backery and Cake</h3>
        <h1  class="sansita-swashed-carousel" >Manis di setiap Gigitan</h1>
        <a href="#produk-grid"><button class="btn mt-3 btl-clr-caroulsel">Pesan Sekarang</button></a>
      
      </div>
    </div>

    <div class="carousel-item">
      <img src="images/carousel/image2.jpg" class="d-block w-100" alt="Slide 2" style="filter:brightness(65%)">
      <div class="carousel-caption carousel-caption-left d-none d-md-block">
      <h3 style="color: #E9BD8C;" >Bonbon Backery and Cake</h3>
        <h1 class="sansita-swashed-carousel" >Second Slide</h1>
        <a href="#produk-grid"><button class="btn mt-3 btl-clr-caroulsel">Jangan Sampai ketinggalan</button></a>
        
      </div>
    </div>

    <div class="carousel-item">
      <img src="images/carousel/image3.jpg" class="d-block w-100" alt="Slide 3" style="filter:brightness(65%)">
      <div class="carousel-caption d-none d-md-block carousel-caption-left">
        <h3 style="color: #E9BD8C;" >Bonbon Backery and Cake</h3>
        <h1 class="sansita-swashed-carousel" >Delightfull!</h1>
        <a href="#produk-grid"><button class="btn mt-3 btl-clr-caroulsel">Pesan Sekarang</button></a>
        
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
    id="promo-section"
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
                    style="width: 70px; background-color: rgba(237, 208, 140, 0.14); border: 1px solid rgba(255,255,255,0.3); color: white;"
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
  <div class="container  align-items-center py-10" id ="tentang-kami" 
  >
    <div
     style="background-image: url('images/background-table.jpg'); background-size: cover; background-position: fix; "
    x-data="{open:false}"  @keyup.esc.window="open=false"
    @click.outside="open = false"
    @keyup.esc.window="open = false "
    class="bg-light p-4 my-10 text-center align-items-center rounded-lg shadow-lg">
      <h4 style="font-family: 'Sansita Swashed', system-ui; font-optical-sizing: auto; font-weight: 600; font-style: bold; font-size: 2rem; " >Tentang Kami</h4>
      <p>Kami berkomitmen menghadirkan kue terbaik dari bahan pilihan.</p>
      <button @click="open=!open" x-text="open? 'tutup':'selengkapnya'" class="py-2 px-5 bg-orange-300 text-white rounded-xl">open sessame</button>
      <div class="d-flex  justify-content-center row g-3 align-items-center px-6 my-4">

        <div x-show="open" x-transition.origin.right.duration.300ms  x-transition.leave.duration.800  class="col"> 
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Lokasi Kami</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Our Location</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
              
              <a href="maps.php"><button class="btn btn-primary"><i class="bi bi-geo-alt-fill"></i></button></a>
            </div>
          </div>
        </div>
        <div x-show="open" x-transition.origin.right.duration.600ms class="col"> 
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Siap Membantu Anda</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Ready to help</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
              
              <a href="pusat-bantuan.php"><button class="btn btn-secondary"><i class="bi bi-headset"></i></button></a>
            </div>
          </div>
        </div>
        <div x-show="open" x-transition.origin.right.duration.900ms x-transition.leave.duration.400 class="col"> 
            <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"> Panduan Kami</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Our rules</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
              
              <a href="panduan-pengguna.php"><button class="btn btn-info"><i class="bi bi-file-earmark-ruled-fill"></i></button></a>
            </div>
          </div>
            
        </div>
      </div>

    </div>
  </div>
  
  <!-- Rekomendasi -->
  <div class="container py-20 mt-10" id="rekomendasi">
    <h4 class="sansita-swashed-carousel text-center mb-3">Rekomendasi Manis</h4>
    <div class="row text-center">
      <div class="row g-3">
    <div class="row">
          <?php
  function getRandomProductsId(){
    global $connect;
    $query_to_rd="SELECT id_barang FROM barang";
    $q_result=mysqli_query($connect,$query_to_rd);
    $dat_random=mysqli_fetch_all($q_result);
    //var_dump($dat_random);
    $arr_random = [];
    foreach ($dat_random as $value) {
        $arr_random[] = $value[0];
    }
    //print_r($arr_random);
    $rand=array_rand($arr_random,3);

    return [$arr_random[$rand[0]], $arr_random[$rand[1]], $arr_random[$rand[2]]];
  }
  //var_dump(getRandomProductsId());

  foreach( getRandomProductsId() as $dat){
    //echo $dat;
    $query_from_rand = "SELECT * FROM barang WHERE id_barang = '$dat'";
    $result = mysqli_query($connect, $query_from_rand);
    $row = mysqli_fetch_assoc($result, );
    //var_dump($row);
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
                    style="width: 70px; background-color: rgba(237, 208, 140, 0.14); border: 1px solid rgba(255,255,255,0.3); color: white;"
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

    
<?php include "resources/footers.php"; ?>


