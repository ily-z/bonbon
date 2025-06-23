<?php session_start();
if(empty($_SESSION['nama'])){ echo "<script>window.location.href='../index.php'</script>"; }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] != 'admin'){ echo "<script>alert('Anda Bukan Admin!'); window.location.href='../logout.php'</script>"; }
include "../conf/connection.php";
 ?>

  <meta charset="UTF-8">
  <title>Admin | Bonbon Bakery and Cake</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../assets/ico/barley.png" rel="shortcut icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3e3cd;
      font-family: 'Sora', sans-serif;
    }
    .navbar {
      background-color: #5e3b25;
    }
    .navbar-brand, .nav-link, .navbar-text {
      color: white !important;
      font-weight: bold;
    }
    .table thead {
      background-color: #c9aa7b;
      color: #000;
    }
    .btn-status {
      font-weight: bold;
    }
    .footer {
      background-color: #1f1f1f;
      color: #ccc;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }
  </style>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-5">
  <h2 class="text-center fw-bold mb-4"><i class="bi bi-list-ul"></i> Daftar Order</h2>
  <div class="table-responsive">
    <table id="tables" class="table table-bordered table-striped align-middle">
      <thead class="text-center">
        <tr>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Alamat Pengiriman</th>
          <th>No Telepon</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM pengguna INNER JOIN transaksi ON pengguna.id_pengguna = transaksi.id_pengguna";
        $query = mysqli_query($connect, $sql);
        while ($data = mysqli_fetch_array($query)) {
          $status = $data['status_transaksi'];
          ?>
          <tr>
            <td><?= ucwords($data['nama']); ?></td>
            <td><?= $data['waktu_transaksi']; ?></td>
            <td><?= $data['alamat']; ?></td>
            <td><?= $data['no_hp']; ?></td>
            <td class="text-center">
              <?php if($status == 'diproses'){ ?>
                <span class="badge text-bg-warning">Menunggu</span>
              <?php } else if($status == 'dikirim'){ ?>
                <span class="badge text-bg-info">Dikirim</span>
              <?php } else if($status == 'selesai'){ ?>
                <span class="badge text-bg-success">Lunas</span>
              <?php } ?>
            </td>
            <td class="text-center">
              <?php if($status == 'diproses'){ ?>
                <a href="lihat-barang.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-sm btn-warning">Lihat Barang</a>
              <?php } else if($status == 'dikirim'){ ?>
                <a href="lihat-barang.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-sm btn-success">Lihat Barang</a>
              <?php } else if($status == 'selesai'){ ?>
                <a href="lihat-barang.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-sm btn-secondary">Lihat Barang</a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Footer -->


<?php include "admin-footer.php"; ?>
</body>
</html>
