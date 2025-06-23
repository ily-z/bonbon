<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
$nama = $_SESSION['nama'];
if($_SESSION['hak'] == 'admin'){}else{ ?> <script> alert('Anda Bukan Admin!'); window.location.href='../logout.php' </script> <?php } 
include "../conf/connection.php";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pengguna | Bonbon Bakery</title>
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
  <h2 class="text-center fw-bold mb-4"><i class="bi bi-people"></i> Data Pengguna</h2>
  <div class="table-responsive">
    <table id="tables" class="table table-bordered table-striped align-middle">
      <thead class="text-center">
        <tr>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Lahir</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select * from pengguna ";
        $query = mysqli_query($connect, $sql);
        while ($data = mysqli_fetch_array($query)){ ?>
          <tr>
            <td><?php echo ucwords("$data[nama]"); ?></td>
            <td><?php echo ucwords("$data[jenis_kelamin]"); ?></td>
            <td><?php echo ucwords("$data[tgl_lahir]"); ?></td>
            <td><?php echo ucwords("$data[hak]"); ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Footer -->
<div class="footer">
  &copy; 2025 Bonbon Bakery and Cake. Hak Cipta Dilindungi
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
      $('#tables').DataTable();
    });
</script>
</body>
</html>
