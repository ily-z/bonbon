<?php
session_start();
include "../conf/connection.php";

if (empty($_SESSION['id'])) {
    header("Location: ../masuk.php");
    exit;
}

// Handle POST request (dari form)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_keranjang = $_POST['id_keranjang'] ?? null;
    $jumlah_baru = $_POST['jumlah_beli'] ?? null;
    
    if ($id_keranjang && $jumlah_baru !== null) {
        $query = mysqli_query($connect, "SELECT jumlah_beli, harga_barang FROM keranjang WHERE id_keranjang = '$id_keranjang'");
        $data = mysqli_fetch_assoc($query);
        
        if ($data) {
            if ($jumlah_baru > 0) {
                // Update jumlah barang
                $total_baru = $jumlah_baru * $data['harga_barang'];
                mysqli_query($connect, "
                    UPDATE keranjang 
                    SET jumlah_beli = '$jumlah_baru', total = '$total_baru' 
                    WHERE id_keranjang = '$id_keranjang'
                ");
                $_SESSION['toast'] = [
                    'type' => 'success',
                    'message' => 'Jumlah barang berhasil diubah'
                ];
            } else {
                // Jika jumlah akan menjadi 0, hapus barang
                mysqli_query($connect, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'");
                $_SESSION['toast'] = [
                    'type' => 'success',
                    'message' => 'Barang dihapus dari keranjang'
                ];
            }
        }
    }
    
    header("Location: keranjang.php");
    exit;
}

// Handle GET request (dari link langsung)
$id_keranjang = $_GET['id'] ?? null;

if ($id_keranjang) {
    $query = mysqli_query($connect, "SELECT jumlah_beli, harga_barang FROM keranjang WHERE id_keranjang = '$id_keranjang'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        if ($data['jumlah_beli'] > 1) {
            $jumlah_baru = $data['jumlah_beli'] - 1;
            $total_baru = $jumlah_baru * $data['harga_barang'];
            mysqli_query($connect, "
                UPDATE keranjang 
                SET jumlah_beli = '$jumlah_baru', total = '$total_baru' 
                WHERE id_keranjang = '$id_keranjang'
            ");
        } else {
            // Jika jumlah tinggal 1, redirect ke halaman konfirmasi
            header("Location: hapus-keranjang.php?id=$id_keranjang");
            exit;
        }
    }
}

header("Location: keranjang.php");
exit;
