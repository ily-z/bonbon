<?php
session_start();
if (empty($_SESSION['nama']) || $_SESSION['hak'] != 'admin') {
    echo "<script>window.location.href='../logout.php'</script>";
    exit;
}
include "../conf/connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang | Bonbon Bakery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Barang Baru</h3>
    <form method="POST" action="proses-tambah-barang.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="id_kategori" class="form-select" required>
                <option value="">Pilih Kategori</option>
                <?php
                $kategori = mysqli_query($connect, "SELECT * FROM kategori");
                while ($kat = mysqli_fetch_assoc($kategori)) {
                    echo "<option value='{$kat['id_kategori']}'>{$kat['kategori']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="barang.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>