<?php
session_start();
include "../conf/connection.php";

if (empty($_SESSION['id']) || $_SESSION['hak'] != 'pengguna') {
    echo "<script>alert('Akses ditolak!'); window.location.href='../index.php';</script>";
    exit;
}

$id_keranjang = $_GET['id'] ?? '';

if ($id_keranjang) {
    $query = mysqli_query($connect, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'");

    if ($query) {
        echo "<script>window.location.href='keranjang.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus item.'); window.location.href='keranjang.php';</script>";
    }
} else {
    echo "<script>alert('ID keranjang tidak ditemukan.'); window.location.href='keranjang.php';</script>";
}
?>
