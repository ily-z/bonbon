<?php
session_start();
if (empty($_SESSION['nama'])) {
    echo "<script> window.location.href='../masuk.php' </script>";
    exit;
}
if ($_SESSION['hak'] != 'pengguna') {
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='../logout.php' </script>";
    exit;
}

include "../conf/connection.php";

$id_pengguna = $_SESSION['id'];
$harga = $_POST['harga'];
$jumlah_baru = (int)$_POST['jumlah'];
$id_barang = $_POST['id_barang'];

// Cek stok saat ini
$cek_stok = mysqli_query($connect, "SELECT stok FROM barang WHERE id_barang = '$id_barang'");
$data_stok = mysqli_fetch_assoc($cek_stok);
$stok_sekarang = (int)$data_stok['stok'];

if ($stok_sekarang < $jumlah_baru) {
    echo "<script> alert('Maaf, stok tidak mencukupi'); window.location.href='home.php'; </script>";
    exit;
}

// Hapus semua produk 'langsung beli' milik user sebelum menambah yang baru
$hapus_lama = mysqli_query($connect, "DELETE FROM keranjang WHERE id_pengguna = '$id_pengguna' AND status = 'langsung beli'");

// Langsung masukkan ke keranjang dengan status 'langsung beli'
$total = $jumlah_baru * $harga;
$insert = mysqli_query($connect, "INSERT INTO keranjang 
    (harga_barang, jumlah_beli, status, total, id_barang, id_pengguna, waktu) 
    VALUES ('$harga', '$jumlah_baru', 'langsung beli', '$total', '$id_barang', '$id_pengguna', NOW())");

// Update stok barang
$sisa_stok = $stok_sekarang - $jumlah_baru;
$update_stok = mysqli_query($connect, "UPDATE barang SET stok = '$sisa_stok' WHERE id_barang = '$id_barang'");

header('Location: checkout-langsung.php');
exit;
?> 