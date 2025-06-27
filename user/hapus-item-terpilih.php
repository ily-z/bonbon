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
$selected_items = $_POST['selected_items'] ?? [];

if (empty($selected_items)) {
    echo "<script> alert('Tidak ada item yang dipilih'); window.location.href='keranjang.php'; </script>";
    exit;
}

// Hapus item yang dipilih
$items_string = implode(',', array_map('intval', $selected_items));
$delete_query = "DELETE FROM keranjang WHERE id_keranjang IN ($items_string) AND id_pengguna = '$id_pengguna' AND status = 'belum bayar'";

if (mysqli_query($connect, $delete_query)) {
    echo "<script> alert('Item yang dipilih berhasil dihapus dari keranjang'); window.location.href='keranjang.php'; </script>";
} else {
    echo "<script> alert('Gagal menghapus item dari keranjang'); window.location.href='keranjang.php'; </script>";
}
?> 