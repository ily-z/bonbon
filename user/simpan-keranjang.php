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
    $_SESSION['toast'] = ['msg' => 'Maaf, stok tidak mencukupi', 'type' => 'error'];
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'home.php'));
    exit;
}

// Cek apakah barang sudah ada di keranjang
$cek_keranjang = mysqli_query($connect, "SELECT * FROM keranjang 
    WHERE id_barang = '$id_barang' AND id_pengguna = '$id_pengguna' AND status = 'belum bayar'");

if (mysqli_num_rows($cek_keranjang) > 0) {
    $row = mysqli_fetch_assoc($cek_keranjang);
    $jumlah_lama = (int)$row['jumlah_beli'];
    $jumlah_total = $jumlah_lama + $jumlah_baru;
    $total = $jumlah_total * $harga;
    $update = mysqli_query($connect, "UPDATE keranjang 
        SET jumlah_beli = '$jumlah_total', total = '$total', waktu = NOW() 
        WHERE id_keranjang = '{$row['id_keranjang']}'");
    $berhasil = $update;
} else {
    $total = $jumlah_baru * $harga;
    $insert = mysqli_query($connect, "INSERT INTO keranjang 
        (harga_barang, jumlah_beli, status, total, id_barang, id_pengguna, waktu) 
        VALUES ('$harga', '$jumlah_baru', 'belum bayar', '$total', '$id_barang', '$id_pengguna', NOW())");
    $berhasil = $insert;
}

// Update stok barang
$sisa_stok = $stok_sekarang - $jumlah_baru;
$update_stok = mysqli_query($connect, "UPDATE barang SET stok = '$sisa_stok' WHERE id_barang = '$id_barang'");

if ($berhasil && $update_stok) {
    $_SESSION['toast'] = ['msg' => 'Berhasil menambah ke keranjang!', 'type' => 'success'];
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'home.php'));
    exit;
} else {
    $_SESSION['toast'] = ['msg' => 'Gagal menambah ke keranjang!', 'type' => 'error'];
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'home.php'));
    exit;
}
?>
