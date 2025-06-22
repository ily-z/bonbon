<?php
session_start();
include "../conf/connection.php";

if (empty($_SESSION['id'])) {
    header("Location: ../masuk.php");
    exit;
}

$id_keranjang = $_GET['id'] ?? null;

if ($id_keranjang) {
    $query = mysqli_query($connect, "SELECT jumlah_beli, harga_barang FROM keranjang WHERE id_keranjang = '$id_keranjang'");
    $data = mysqli_fetch_assoc($query);

    if ($data && $data['jumlah_beli'] > 1) {
        $jumlah_baru = $data['jumlah_beli'] - 1;
        $total_baru = $jumlah_baru * $data['harga_barang'];

        mysqli_query($connect, "
            UPDATE keranjang 
            SET jumlah_beli = '$jumlah_baru', total = '$total_baru' 
            WHERE id_keranjang = '$id_keranjang'
        ");
    }
}

header("Location: keranjang.php");
exit;
