<?php
session_start();
if (empty($_SESSION['nama']) || $_SESSION['hak'] != 'admin') {
    echo "<script>window.location.href='../logout.php'</script>";
    exit;
}
include "../conf/connection.php";

// === Jika form disubmit ===
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang   = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $id_kategori = $_POST['id_kategori'];

    $nama_foto = $_FILES['foto']['name'];
    $file_tmp  = $_FILES['foto']['tmp_name'];

    if (!empty($nama_foto)) {
        $lokasi = '../images/product/';
        move_uploaded_file($file_tmp, $lokasi . $nama_foto);

        // hapus gambar lama
        $img_lama = $_POST['img'];
        if (file_exists("../images/product/$img_lama")) {
            unlink("../images/product/$img_lama");
        }
    } else {
        $nama_foto = $_POST['img']; // pakai gambar lama
    }

    // eksekusi query update
    $sql = "UPDATE barang SET 
                nama_barang = '$nama_barang',
                harga = '$harga',
                stok = '$stok',
                gambar = '$nama_foto',
                id_kategori = '$id_kategori'
            WHERE id_barang = '$id_barang'";
    $query = mysqli_query($connect, $sql);

    if ($query) {
        echo "<script>window.location.href='barang.php'</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); window.location.href='barang.php'</script>";
    }
    exit;
}

// === Jika form belum disubmit, tampilkan form edit ===
if (!isset($_GET['id_barang'])) {
    echo "<script>alert('ID barang tidak ditemukan!'); window.location.href='barang.php'</script>";
    exit;
}

$id = $_GET['id_barang'];
$sql = "SELECT * FROM barang WHERE id_barang = '$id'";
$query = mysqli_query($connect, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data barang tidak ditemukan'); window.location.href='barang.php'</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Barang | Bonbon Bakery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Edit Barang: <?= $data['nama_barang']; ?></h3>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_barang" value="<?= $data['id_barang']; ?>">
    <input type="hidden" name="img" value="<?= $data['gambar']; ?>">

    <div class="mb-3">
      <label>Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Harga</label>
      <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Stok</label>
      <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Kategori</label>
      <select name="id_kategori" class="form-select" required>
        <?php
        $kategori = mysqli_query($connect, "SELECT * FROM kategori");
        while ($kat = mysqli_fetch_assoc($kategori)) {
          $selected = $kat['id_kategori'] == $data['id_kategori'] ? 'selected' : '';
          echo "<option value='{$kat['id_kategori']}' $selected>{$kat['kategori']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Foto (biarkan kosong jika tidak diubah)</label>
      <input type="file" name="foto" class="form-control">
      <div class="mt-2"><img src="../images/product/<?= $data['gambar'] ?>" width="120" alt=""></div>
    </div>

    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="barang.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
