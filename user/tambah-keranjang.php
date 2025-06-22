<?php
session_start();
include "../conf/connection.php";

if (empty($_SESSION['id'])) {
    header("Location: ../masuk.php");
    exit;
}

$id_keranjang = $_GET['id'] ?? null;

if ($id_keranjang) {
    // Ambil data saat ini
    $query = mysqli_query($connect, "SELECT jumlah_beli, stok FROM keranjang 
        JOIN barang ON keranjang.id_barang = barang.id_barang 
        WHERE id_keranjang = '$id_keranjang'");
    
    $data = mysqli_fetch_assoc($query);

    if ($data && $data['jumlah_beli'] < $data['stok']) {
        $jumlah_baru = $data['jumlah_beli'] + 1;
        $harga = mysqli_fetch_assoc(mysqli_query($connect, "
            SELECT harga FROM barang 
            JOIN keranjang ON barang.id_barang = keranjang.id_barang 
            WHERE keranjang.id_keranjang = '$id_keranjang'
        "))['harga'];

        $total_baru = $jumlah_baru * $harga;

        // Update keranjang
        mysqli_query($connect, "
            UPDATE keranjang 
            SET jumlah_beli = '$jumlah_baru', total = '$total_baru' 
            WHERE id_keranjang = '$id_keranjang'
        ");
    }
}

header("Location: keranjang.php");
exit;
