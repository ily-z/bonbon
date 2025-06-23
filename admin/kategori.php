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
    <title>Data Kategori | Bonbon Bakery</title>
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
        .btn-edit {
            background-color: #ffe8d6;
            color: #5e3b25;
            font-weight: bold;
            border-radius: 8px;
            border: none;
            padding: 5px 15px;
        }
        .btn-hapus {
            background-color: #d7a86e;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            padding: 5px 15px;
        }
        .btn-tambah {
            background-color: #8c6849;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            padding: 10px 20px;
            border: none;
        }
        .btn-edit:hover {
            background-color: #f2d2b1;
        }
        .btn-hapus:hover {
            background-color: #c28553;
        }
        .btn-tambah:hover {
            background-color: #6d5238;
        }
    </style>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-5">
  <h2 class="text-center fw-bold mb-4"><i class="bi bi-tags"></i> Data Kategori</h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="table-responsive">
        <table id="tables" class="table table-bordered table-striped align-middle">
          <thead class="text-center">
            <tr>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "select * from kategori";
            $query = mysqli_query($connect, $sql);
            $no = 1;
            while ($data = mysqli_fetch_array($query)){ ?>
              <tr>
                <td><?php echo ucwords("$data[kategori]"); ?></td>
                <td class="text-center">
                  <button class="btn btn-edit me-2" data-bs-toggle="modal" data-bs-target="#edit<?php echo $no; ?>">Edit</button>
                  <a href="hapus-kategori.php?id_kategori=<?php echo "$data[id_kategori]"; ?>" onclick='return confirm("Anda Yakin?")' class="btn btn-hapus">Hapus</a>
                </td>
              </tr>
              <!-- Modal Edit -->
              <div class="modal fade" id="edit<?php echo $no; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Kategori</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <form action="edit-kategori.php" method="POST">
                        <input type="hidden" name="id_kategori" value="<?php echo "$data[id_kategori]"; ?>">
                        <input type="text" name="kategori" class="form-control" maxlength="35" placeholder="Masukkan Kategori.." value="<?php echo "$data[kategori]"; ?>" required/>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">OK</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php $no++; } ?>
          </tbody>
        </table>
      </div>
      <div class="text-center mt-4">
        <button class="btn btn-tambah" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Kategori</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="tambah-kategori.php" method="POST">
          <input type="text" name="kategori" class="form-control" maxlength="35" placeholder="Masukkan Kategori.." required/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">OK</button>
        </form>
      </div>
    </div>
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
