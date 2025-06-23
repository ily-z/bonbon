<?php
session_start();
if (empty($_SESSION['nama'])) {
    echo "<script>window.location.href='../index.php'</script>";
}
$nama = $_SESSION['nama'];
if ($_SESSION['hak'] != 'admin') {
    echo "<script>alert('Anda Bukan Admin!'); window.location.href='../logout.php'</script>";
}
include "../conf/connection.php";

// Fungsi pendukung
function bindingarr($arr) {
    $result = [];
    foreach ($arr as $data) {
        $tanggal = $data['waktu_transaksi'];
        $subtotal = $data['subtotal'];
        if (!isset($result[$tanggal])) {
            $result[$tanggal] = $subtotal;
        } else {
            $result[$tanggal] += $subtotal;
        }
    }
    return $result;
}
function totalByDay($array) {
    return $array; // Sudah dijumlahkan di atas
}
function ambiltangal($array) {
    return array_keys($array);
}
function ambiltotal($array) {
    return array_values($array);
}
function ambiltotalsemua($array) {
    $transaksi = count($array);
    $total = 0;
    foreach ($array as $data) {
        $total += $data['subtotal'];
    }
    return [$transaksi, $total];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan | Bonbon Bakery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/ico/barley.png" rel="shortcut icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f3e3cd;
            font-family: 'Sora', sans-serif;
        }
        .table thead {
            background-color: #c9aa7b;
            color: #000;
        }
        .btn-status {
            font-weight: bold;
        }
        .btn-coklat {
            background-color: #5e3b25;
            color: white;
            border-radius: 8px;
        }
        .btn-coklat:hover {
            background-color: #3c2717;
        }
        .section-box {
            background-color: #d8b58b;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .page-header h2 {
            font-family: 'Sansita Swashed', cursive;
            color: #5e3b25;
            padding-top: 20px;
        }
    </style>
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container mt-5">
    <div class="page-header">
        <h2 class="text-center fw-bold mb-4"><i class="bi bi-bar-chart-fill"></i> Laporan Keuangan</h2>
    </div>

    <div class="section-box mb-4">
        <form action="report.php" method="POST" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" name="tanggalawal" required value="<?= $_POST['tanggalawal'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tanggalakhir" required value="<?= $_POST['tanggalakhir'] ?? '' ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-coklat w-100">Lihat Laporan Transaksi</button>
            </div>
        </form>
    </div>

<?php
$tabeldata = [];
$data = [];
$tglawal = $_POST['tanggalawal'] ?? null;
$tglakhir = $_POST['tanggalakhir'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tglawal && $tglakhir) {
    $query = "SELECT DATE(waktu_transaksi) as waktu_transaksi, subtotal FROM transaksi 
              WHERE status_transaksi = 'lunas' 
              AND (DATE(waktu_transaksi) BETWEEN '$tglawal' AND '$tglakhir')";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $tabeldata = totalByDay(bindingarr($data));
}
?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($data)): ?>
    <div class="alert alert-warning text-center">
        Tidak ada transaksi lunas ditemukan untuk rentang tanggal yang dipilih.
    </div>
<?php endif; ?>

<?php if (!empty($tabeldata)) : ?>
<div class="container mb-5 section-box">
    <h5 class="text-center">Grafik Pendapatan</h5>
    <canvas id="myChart" height="100"></canvas>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(ambiltangal($tabeldata)) ?>,
                datasets: [{
                    label: 'Pendapatan Harian',
                    data: <?= json_encode(ambiltotal($tabeldata)) ?>,
                    backgroundColor: '#c89e74',
                    borderColor: '#5e3b25',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <hr>

    <h5 class="mt-4">Detail Transaksi</h5>
    <table class="table table-bordered table-striped">
        <thead class="text-center">
            <tr>
                <th>Tanggal</th>
                <th>Total Per Hari</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tabeldata as $key => $val): ?>
            <tr>
                <td class="text-center"><?= $key ?></td>
                <td class="text-center">Rp <?= number_format($val, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h5 class="mt-4">Rekap Keseluruhan</h5>
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>Total Transaksi</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tr>
            <td class="text-center"><?= ambiltotalsemua($data)[0] ?></td>
            <td class="text-center">Rp <?= number_format(ambiltotalsemua($data)[1], 0, ',', '.') ?></td>
        </tr>
    </table>

    <form action="cetak-report.php" method="get" class="mt-3">
        <input type="hidden" name="tanggalawal" value="<?= $tglawal ?>">
        <input type="hidden" name="tanggalakhir" value="<?= $tglakhir ?>">
        <button type="submit" class="btn btn-coklat">Cetak Report</button>
    </form>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>