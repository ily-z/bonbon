<?php session_start();
if(empty($_SESSION['nama'])){ ?>
  <script> window.location.href='../masuk.php' </script>
<?php }
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
if($_SESSION['hak'] != 'admin'){ ?>
  <script> alert('Anda Bukan Admin!'); window.location.href='../logout.php' </script>
<?php }
include "../conf/connection.php";
$sql = "SELECT * FROM pengguna WHERE id_pengguna='$id'";
$query = mysqli_query($connect, $sql);
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Admin | Bonbon Bakery and Cake</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../assets/ico/barley.png" rel="shortcut icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@600&family=Sora&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Sora', sans-serif;
      background-color: #f3e3cd;
    }
    .section-title {
      font-family: 'Sansita Swashed', cursive;
      font-size: 2rem;
      color: #5a3e2c;
      text-align: center;
      margin-top: 40px;
    }
    .form-label {
      font-weight: 600;
    }
    .profile-box {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.07);
      padding: 30px;
      margin: 30px auto;
    }
    .btn-custom {
      background-color: #c9aa7b;
      color: #fff;
      font-weight: bold;
    }
    .btn-custom:hover {
      background-color: #a9834d;
      color: #fff;
    }
    .form-control[readonly] {
      background-color: #fef9f4;
      border: 1px solid #c8b8a5;
    }
    .icon-action {
      font-size: 1.3rem;
      cursor: pointer;
      margin-right: 10px;
    }
    .icon-action:hover {
      color: #a9834d;
    }
  </style>
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container">
  <h2 class="section-title"><i class="bi bi-person-fill"></i> Profil Admin</h2>
  <div class="row justify-content-center">
    <div class="col-md-8 profile-box">
      <form>
        <div class="mb-2"><span class="badge bg-dark">Admin</span></div>

        <?php if(!empty($data['nama'])) { ?>
          <label class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control mb-2" value="<?= $data['nama']; ?>" readonly>
        <?php } ?>

        <?php if(!empty($data['username'])) { ?>
          <label class="form-label">Nama Pengguna</label>
          <input type="text" class="form-control mb-2" value="<?= $data['username']; ?>" readonly>
        <?php } ?>

        <?php if(!empty($data['jenis_kelamin'])) { ?>
          <label class="form-label">Jenis Kelamin</label>
          <input type="text" class="form-control mb-2" value="<?= $data['jenis_kelamin']; ?>" readonly>
        <?php } ?>

        <?php if(!empty($data['email'])) { ?>
          <label class="form-label">Email</label>
          <input type="email" class="form-control mb-2" value="<?= $data['email']; ?>" readonly>
        <?php } ?>

        <?php if(!empty($data['tgl_lahir'])) { ?>
          <label class="form-label">Tanggal Lahir</label>
          <input type="text" class="form-control mb-2" value="<?= date("d F Y", strtotime($data['tgl_lahir'])); ?>" readonly>
        <?php } ?>

        <div class="mt-4 d-flex justify-content-between">
          <div>
            <a href="#" data-bs-toggle="modal" data-bs-target="#edit" class="icon-action text-success"><i class="bi bi-pencil-square"></i></a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#hapus" class="icon-action text-danger"><i class="bi bi-trash-fill"></i></a>
          </div>
          <a href="home.php" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="edit-user.php" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Profil Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <label>Nama</label>
        <input type="text" class="form-control mb-2" name="nama" value="<?= $data['nama']; ?>" required>
        <label>Jenis Kelamin</label>
        <select class="form-control mb-2" name="jenis_kelamin">
          <option><?= $data['jenis_kelamin']; ?></option>
          <?php if($data['jenis_kelamin'] == 'Laki-laki') echo '<option>Perempuan</option>';
                else echo '<option>Laki-laki</option>'; ?>
        </select>
        <label>Tanggal Lahir</label>
        <input type="date" class="form-control mb-2" name="tgl_lahir" value="<?= $data['tgl_lahir']; ?>" required>
        <label>Nama Pengguna</label>
        <input type="text" class="form-control mb-2" name="user" value="<?= $data['username']; ?>" required>
        <label>Kata Sandi Lama</label>
        <input type="password" class="form-control mb-2" name="pass_lama" required>
        <label>Kata Sandi Baru</label>
        <input type="password" class="form-control mb-2" name="pass_baru" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapus" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="hapus-user.php" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Masukkan password Anda untuk menghapus akun:</p>
        <input type="password" class="form-control" name="pass" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
