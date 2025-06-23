<?php
session_start();
if (empty($_SESSION['nama'])) {
    echo "<script>window.location.href='../index.php'</script>";
    exit;
}
if ($_SESSION['hak'] != 'admin') {
    echo "<script>alert('Anda Bukan Admin!'); window.location.href='../logout.php'</script>";
    exit;
}

include "../conf/connection.php";

// Validasi input
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script>alert('Metode tidak valid!'); window.location.href='barang.php'</script>";
    exit;
}

$id_barang = $_POST['id_barang'] ?? '';
$nama_barang = $_POST['nama_barang'] ?? '';
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$id_kategori = $_POST['id_kategori'] ?? '';
$gambar_lama = $_POST['img'] ?? '';

// Validasi data wajib
if (empty($id_barang) || empty($nama_barang) || empty($harga) || empty($stok) || empty($id_kategori)) {
    echo "<script>alert('Semua field wajib diisi!'); window.location.href='edit-barang.php?id_barang=$id_barang'</script>";
    exit;
}

// Cek apakah ada file yang diupload
if (!empty($_FILES['foto']['name'])) {
    $nama_foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $lokasi = '../images/product/';
    
    // Validasi tipe file
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($nama_foto, PATHINFO_EXTENSION));
    
    if (!in_array($file_extension, $allowed_types)) {
        echo "<script>alert('Tipe file tidak diizinkan! Gunakan JPG, JPEG, PNG, atau GIF.'); window.location.href='edit-barang.php?id_barang=$id_barang'</script>";
        exit;
    }
    
    // Hapus gambar lama jika ada
    if (!empty($gambar_lama) && file_exists($lokasi . $gambar_lama)) {
        unlink($lokasi . $gambar_lama);
    }
    
    // Upload file baru
    if (!move_uploaded_file($file_tmp, $lokasi . $nama_foto)) {
        echo "<script>alert('Gagal mengupload file!'); window.location.href='edit-barang.php?id_barang=$id_barang'</script>";
        exit;
    }
} else {
    // Gunakan gambar lama
    $nama_foto = $gambar_lama;
}

// Update database
$sql = "UPDATE barang SET 
        nama_barang = '$nama_barang',
        harga = '$harga',
        stok = '$stok',
        gambar = '$nama_foto',
        id_kategori = '$id_kategori'
        WHERE id_barang = '$id_barang'";

$query = mysqli_query($connect, $sql);

if ($query) {
    echo "<script>alert('Data barang berhasil diupdate!'); window.location.href='barang.php'</script>";
} else {
    echo "<script>alert('Gagal mengupdate data barang! Error: " . mysqli_error($connect) . "'); window.location.href='edit-barang.php?id_barang=$id_barang'</script>";
}
?> 