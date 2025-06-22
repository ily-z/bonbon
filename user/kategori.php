<?php
session_start();
if (empty($_SESSION['nama'])) { ?>
    <script>
        window.location.href = '../masuk.php'
    </script>
<?php }
$nama = $_SESSION['nama'];
if ($_SESSION['hak'] != 'pengguna') { ?>
    <script>
        alert('Anda Bukan Pengguna!');
        window.location.href = '../logout.php'
    </script>
<?php }
include "../conf/connection.php";

// Ambil nama kategori
$kategori_id = isset($_GET['kategori']) ? intval($_GET['kategori']) : 0; // Pastikan kategori adalah integer
$query_kategori = mysqli_query($connect, "SELECT kategori FROM kategori WHERE id_kategori='$kategori_id'");
$nama_kategori = "Tidak Ditemukan"; // Default value
if (mysqli_num_rows($query_kategori) > 0) {
    $nama_kategori = mysqli_fetch_array($query_kategori)['kategori'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori <?php echo htmlspecialchars($nama_kategori); ?> | Bonbon Bakery and Cake</title>
    <link rel="shortcut icon" href="../assets/ico/barley.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sora', sans-serif;
            background-color: #f3e3cd;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #C9AA7B;
        }

        .navbar-brand,
        .nav-link,
        .navbar-text {
            color: white !important;
            font-weight: bold;
        }

        .sidebar {
            background-color: #AD8D5C;
            padding: 20px;
            border-radius: 10px;
            color: white;
            margin-bottom: 20px;
        }

        .sidebar h5 {
            margin-top: 20px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 5px;
            font-family: 'Sansita Swashed', cursive;
            font-size: 1.3rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .product-box {
            background: url('../images/content/dark-texture-produk.png') center/cover no-repeat;
            color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%; /* Memastikan tinggi yang konsisten */
        }

        .product-box img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Tombol "Beli" sekarang ada di dalam form, jadi tidak perlu posisi absolut di sini */
        /* .product-box button {
            background-color: #C9AA7B;
            border: none;
            padding: 8px 12px;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        } */

        .product-box .form-control[type=number] {
            width: 80px;
            /* margin-bottom: 10px; */ /* Dihapus, akan diatur oleh mb-2 atau gap di form */
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .product-box .form-control[type=number]::placeholder {
            color: white;
        }

        .product-box .form-control[type=number]:focus {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .price-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px; /* Tambahkan sedikit spasi */
            margin-bottom: 10px;
        }

        .info-link {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            color: white;
            border: 1px solid white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .pagination .page-link {
            color: #C9AA7B;
            font-weight: bold;
        }

        .pagination .active .page-link {
            background-color: #C9AA7B;
            border-color: #C9AA7B;
            color: white;
        }

        .section-title {
            font-family: 'Sansita Swashed', cursive;
            font-size: 2rem;
            margin: 30px 0;
        }

        .new-product {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .new-product:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .new-product img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 10px;
        }

        .new-product .info {
            flex-grow: 1;
        }

        .new-product .info span {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 3px;
        }

        .new-product .info strong {
            display: block;
            font-size: 0.85rem;
        }

        .new-product a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <?php include "navbar.php"; ?>

    <div class="container mt-4">
        <h2 class="text-center section-title">
            Kategori <?php echo htmlspecialchars($nama_kategori); ?> <i class="bi bi-cake2-fill text-warning"></i>
        </h2>
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="sidebar">
                    <form action="search.php" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control" placeholder="Cari produk..." aria-label="Cari produk">
                            <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <h5>Kategori</h5>
                    <ul class="list-unstyled">
                        <?php
                        $sql = "select * from kategori";
                        $query = mysqli_query($connect, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                            echo "<li><a href='kategori.php?kategori=" . htmlspecialchars($data['id_kategori']) . "'>" . htmlspecialchars($data['kategori']) . "</a></li>";
                        }
                        ?>
                    </ul>
                    <h5 class="mt-4">Tentang</h5>
                    <ul class="list-unstyled">
                        <li><a href="costumer-service.php">Layanan Pelanggan</a></li>
                        <li><a href="pusat-bantuan.php">Pusat Bantuan</a></li>
                        <li><a href="maps.php">Maps</a></li>
                        <li><a href="panduan-pengguna.php">Panduan Pengguna</a></li>
                    </ul>
                    <h5 class="mt-4">Produk Baru</h5>
                    <?php
                    $new = mysqli_query($connect, "SELECT * FROM barang ORDER BY id_barang DESC LIMIT 2");
                    while ($item = mysqli_fetch_array($new)) {
                        echo "<a href='detail-produk.php?id=" . htmlspecialchars($item['id_barang']) . "' class='new-product'>
                                <img src='../images/product/" . htmlspecialchars($item['gambar']) . "' alt='" . htmlspecialchars($item['nama_barang']) . "'>
                                <div class='info'>
                                    <span>" . htmlspecialchars($item['nama_barang']) . "</span>
                                    <strong>Rp " . number_format($item['harga']) . "</strong>
                                </div>
                              </a>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $limit = 9;
                    $offset = ($page - 1) * $limit;
                    $produk = mysqli_query($connect, "SELECT * FROM barang WHERE id_kategori='$kategori_id' LIMIT $offset,$limit");
                    if (mysqli_num_rows($produk) > 0) {
                        while ($row = mysqli_fetch_array($produk)) {
                    ?>
                            <div class="col">
                                <div class="product-box">
                                    <img src="../images/product/<?php echo htmlspecialchars($row['gambar']); ?>" class="img-fluid mb-2">
                                    <h5 class="mt-2"><?php echo ucwords(htmlspecialchars($row['nama_barang'])); ?></h5>
                                    <div class="price-info">
                                        <span>Rp <?php echo number_format($row['harga']); ?></span>
                                        <a href="detail-produk.php?id=<?php echo htmlspecialchars($row['id_barang']); ?>" class="info-link">i</a>
                                    </div>
                                    <form method="POST" action="simpan-keranjang.php" class="d-flex align-items-center gap-2 mt-auto">
                                        <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($row['id_barang']); ?>">
                                        <input type="hidden" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>">
                                        <input type="hidden" name="stok" value="<?php echo htmlspecialchars($row['stok']); ?>">
                                        <input type="number" name="jumlah" class="form-control form-control-sm" value="1" min="1" max="<?php echo htmlspecialchars($row['stok']); ?>" required>
                                        <button type="submit" class="btn btn-sm" style="background-color: #C9AA7B; color: white; font-weight: bold;">Beli</button>
                                    </form>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo "<div class='col-12'><div class='alert alert-warning text-center' role='alert'><h4>Produk tidak ditemukan dalam kategori ini!</h4></div></div>";
                    } ?>
                </div>

                <nav class="mt-4" aria-label="Navigasi Halaman Produk">
                    <ul class="pagination justify-content-center">
                        <?php
                        $total = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM barang WHERE id_kategori='$kategori_id'"));
                        $pages = ceil($total / $limit);
                        $show = 3; // Tampilkan hanya 3 page
                        $start = max(1, $page - 1);
                        $end = min($pages, $start + $show - 1);

                        if ($start > 1) {
                            echo "<li class='page-item'><a class='page-link' href='kategori.php?kategori=$kategori_id&page=" . ($start - 1) . "' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                        }

                        for ($i = $start; $i <= $end; $i++) {
                            $active = ($i == $page) ? 'active' : '';
                            echo "<li class='page-item $active'><a class='page-link' href='kategori.php?kategori=$kategori_id&page=$i'>$i</a></li>";
                        }

                        if ($end < $pages) {
                            echo "<li class='page-item'><a class='page-link' href='kategori.php?kategori=$kategori_id&page=" . ($end + 1) . "' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>