<?php
session_start();
if (empty($_SESSION['nama'])) {
    echo "<script>window.location.href='../index.php'</script>";
}
$nama = $_SESSION['nama'];
if ($_SESSION['hak'] != 'admin') {
    echo "<script>alert('Anda Bukan Admin!'); window.location.href='../logout.php'</script>";
}
include "../conf/connection.php";

// Proses UPDATE jika form edit dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_barang'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $id_kategori = $_POST['id_kategori'];
    
    $foto_lama = $_POST['img'];
    $nama_foto = $foto_lama;

    if (!empty($_FILES['foto']['tmp_name'])) {
        $nama_foto = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        $lokasi = '../images/product/';
        move_uploaded_file($file_tmp, $lokasi.$nama_foto);

        if (file_exists($lokasi.$foto_lama)) {
            unlink($lokasi.$foto_lama);
        }
    }

    $sql = "UPDATE barang SET nama_barang='$nama_barang', harga='$harga', stok='$stok', gambar='$nama_foto', id_kategori='$id_kategori' WHERE id_barang='$id_barang'";
    $query = mysqli_query($connect, $sql);
    echo "<script>window.location.href='barang.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Data Barang | Bonbon Bakery</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../assets/ico/barley.png" rel="shortcut icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3e3cd;
      font-family: 'Sora', sans-serif;
    }
    .table thead {
      background-color: #c9aa7b;
      color: #000;
    }
    .btn-status {
      font-weight: bold;
    }
    .footer {
      background-color: #2f2f2f;
      color: white;
      padding: 15px;
      text-align: center;
      margin-top: 50px;
    }
    .table th, .table td {
      text-align: center;
      vertical-align: middle !important;
    }
    .btn-edit {
      background-color: #ffe8d6;
      color: #5e3b25;
      font-weight: bold;
      border-radius: 8px;
      border: none;
      padding: 5px 15px;
    }
    .btn-hapus {
      background-color: #d7a86e;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      padding: 5px 15px;
    }
    .btn-edit:hover {
      background-color: #f2d2b1;
    }
    .btn-hapus:hover {
      background-color: #c28553;
    }
    .btn-tambah, .btn-cetak {
      background-color: #8c6849;
      color: white;
      font-weight: bold;
      border-radius: 10px;
      padding: 10px 20px;
      border: none;
    }
    .btn-cetak {
      background-color: #f3c8b3;
      color: #5e3b25;
    }
    .modal-content {
      background-color: #d8b58b;
      color: #3e2c1b;
      border-radius: 15px;
    }
    .modal-title {
      font-weight: bold;
      font-family: 'Sansita Swashed', cursive;
    }
  </style>
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-5">
  <h2 class="text-center fw-bold mb-4"><i class="bi bi-box-seam"></i> Data Barang</h2>

  <table class="table table-bordered table-striped align-middle">
    <thead class="text-center">
      <tr>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stock</th>
        <th>Kategori</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM kategori INNER JOIN barang ON kategori.id_kategori = barang.id_kategori";
      $query = mysqli_query($connect, $sql);
      while ($data = mysqli_fetch_array($query)) {
      ?>
        <tr>
          <td><?= ucwords($data['nama_barang']); ?></td>
          <td>Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
          <td><?= $data['stok']; ?></td>
          <td><?= ucwords($data['kategori']); ?></td>
          <td>
            <button class="btn btn-edit me-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id_barang'] ?>">Edit</button>
            <a href="hapus-barang.php?id_barang=<?= $data['id_barang']; ?>" onclick="return confirm('Yakin ingin hapus?')" class="btn btn-hapus">Hapus</a>
          </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal<?= $data['id_barang'] ?>" tabindex="-1">
          <div class="modal-dialog">
            <form method="POST" enctype="multipart/form-data" class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="edit_barang" value="1">
                <input type="hidden" name="id_barang" value="<?= $data['id_barang'] ?>">
                <input type="hidden" name="img" value="<?= $data['gambar'] ?>">
                <div class="mb-2">
                  <label>Nama Barang</label>
                  <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang'] ?>" required>
                </div>
                <div class="mb-2">
                  <label>Stok</label>
                  <input type="number" name="stok" class="form-control" value="<?= $data['stok'] ?>" required>
                </div>
                <div class="mb-2">
                  <label>Harga</label>
                  <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
                </div>
                <div class="mb-2">
                  <label>Kategori</label>
                  <select name="id_kategori" class="form-select">
                    <?php
                    $kategori_query = mysqli_query($connect, "SELECT * FROM kategori");
                    while ($kat = mysqli_fetch_array($kategori_query)) {
                      $selected = $kat['id_kategori'] == $data['id_kategori'] ? 'selected' : '';
                      echo "<option value='$kat[id_kategori]' $selected>$kat[kategori]</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-2">
                  <label>Gambar (optional)</label>
                  <input type="file" name="foto" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">OK</button>
              </div>
            </form>
          </div>
        </div>

      <?php } ?>
    </tbody>
  </table>

  <div class="text-center mt-4">
    <a href="tambah-barang.php" class="btn btn-tambah me-3">Tambah Barang</a>
    <a href="cetak-barang.php" class="btn btn-cetak" target="_blank">Cetak</a>
  </div>
</div>

<!-- Footer -->
<div class="footer">
  &copy; 2025 Bonbon Bakery and Cake. Hak Cipta Dilindungi
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
