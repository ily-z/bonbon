<?php
session_start();
if (empty($_SESSION['nama']) || $_SESSION['hak'] != 'admin') {
    echo "<script>window.location.href='../logout.php'</script>";
    exit;
}

include "../conf/connection.php";

// Validasi method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script>alert('Metode tidak valid!'); window.location.href='barang.php'</script>";
    exit;
}

// Ambil data dari form
$nama_barang = $_POST['nama_barang'] ?? '';
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$id_kategori = $_POST['id_kategori'] ?? '';

// Validasi data wajib
if (empty($nama_barang) || empty($harga) || empty($stok) || empty($id_kategori)) {
    echo "<script>alert('Semua field wajib diisi!'); window.location.href='tambah-barang.php'</script>";
    exit;
}

// Validasi file upload
if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] != 0) {
    echo "<script>alert('Gambar wajib diupload!'); window.location.href='tambah-barang.php'</script>";
    exit;
}

$nama_foto = $_FILES['gambar']['name'];
$file_tmp = $_FILES['gambar']['tmp_name'];
$lokasi = '../images/product/';

// Validasi tipe file
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
$file_extension = strtolower(pathinfo($nama_foto, PATHINFO_EXTENSION));

if (!in_array($file_extension, $allowed_types)) {
    echo "<script>alert('Tipe file tidak diizinkan! Gunakan JPG, JPEG, PNG, atau GIF.'); window.location.href='tambah-barang.php'</script>";
    exit;
}

// Upload file
if (!move_uploaded_file($file_tmp, $lokasi . $nama_foto)) {
    echo "<script>alert('Gagal mengupload file!'); window.location.href='tambah-barang.php'</script>";
    exit;
}

// Insert ke database
$sql = "INSERT INTO barang (nama_barang, harga, stok, gambar, id_kategori) 
        VALUES ('$nama_barang', '$harga', '$stok', '$nama_foto', '$id_kategori')";

$query = mysqli_query($connect, $sql);

if ($query) {
    echo "<script>alert('Barang berhasil ditambahkan!'); window.location.href='barang.php'</script>";
} else {
    // Hapus file yang sudah diupload jika gagal insert
    if (file_exists($lokasi . $nama_foto)) {
        unlink($lokasi . $nama_foto);
    }
    echo "<script>alert('Gagal menambahkan barang! Error: " . mysqli_error($connect) . "'); window.location.href='tambah-barang.php'</script>";
}
?> 