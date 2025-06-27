<?php
session_start();
include "../conf/connection.php";
if (empty($_SESSION['id']) || $_SESSION['hak'] != 'pengguna') {
    http_response_code(403);
    echo json_encode(['status'=>'error','msg'=>'Akses ditolak']);
    exit;
}
$id_keranjang = $_POST['id'] ?? '';
$aksi = $_POST['aksi'] ?? '';
if (!$id_keranjang || !$aksi) {
    http_response_code(400);
    echo json_encode(['status'=>'error','msg'=>'Data tidak lengkap']);
    exit;
}
// Ambil jumlah sekarang
$q = mysqli_query($connect, "SELECT jumlah_beli FROM keranjang WHERE id_keranjang='$id_keranjang'");
if (!$row = mysqli_fetch_assoc($q)) {
    http_response_code(404);
    echo json_encode(['status'=>'error','msg'=>'Data tidak ditemukan']);
    exit;
}
$jumlah = (int)$row['jumlah_beli'];
if ($aksi == 'plus') {
    $jumlah++;
} elseif ($aksi == 'minus') {
    $jumlah--;
}
if ($jumlah <= 0) {
    // Hapus item
    mysqli_query($connect, "DELETE FROM keranjang WHERE id_keranjang='$id_keranjang'");
    echo json_encode(['status'=>'ok','deleted'=>true]);
    exit;
}
// Update jumlah
mysqli_query($connect, "UPDATE keranjang SET jumlah_beli='$jumlah', total=harga_barang*$jumlah WHERE id_keranjang='$id_keranjang'");
echo json_encode(['status'=>'ok','jumlah'=>$jumlah]); 