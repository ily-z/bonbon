<?php
session_start();
if (empty($_SESSION['nama'])) { ?>
    <script>
        window.location.href = '../index.php'
    </script>
<?php }
$nama = $_SESSION['nama'];
if ($_SESSION['hak'] == 'admin') {
} else { ?>
    <script>
        alert('Anda Bukan Admin!');
        window.location.href = '../logout.php'
    </script>
<?php }
include "../conf/connection.php";
include "admin-navbar.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Barley Bakery and Cake </title>
    <link href="../assets/ico/barley.jpeg" rel="shorcut icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>

<body>

    <div class="container">
        <br><br><br><br>
        <div class="page-header">
            <h2> Data Barang </h2>
        </div>
        <table id="tables" class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;"> Nama Barang </th>
                    <th style="text-align: center;"> Harga </th>
                    <th style="text-align: center;"> Stok </th>
                    <th style="text-align: center;"> Kategori </th>
                    <th style="text-align: center;"> Aksi </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select * from kategori inner join barang on kategori.id_kategori = barang.id_kategori";
                $query = mysqli_query($connect, $sql);
                $no = 1;
                while ($data = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?php echo ucwords("$data[nama_barang]"); ?></td>
                        <td>Rp. <?php echo number_format($data['harga']); ?></td>
                        <td><?php echo ucwords("$data[stok]"); ?></td>
                        <td><?php echo ucwords("$data[kategori]"); ?></td>
                        <td>
                            <center>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditBarang<?php echo $no; ?>">Edit</button>
                                <a href="hapus-barang.php?id_barang=<?php echo "$data[id_barang]"; ?>" onclick='return confirm("Anda Yakin?")' class="btn btn-danger">Hapus</a>
                            </center>
                        </td>
                    </tr>
                    <div class="modal fade" id="EditBarang<?php echo $no; ?>" tabindex="-1" aria-labelledby="EditBarangLabel<?php echo $no; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="EditBarangLabel<?php echo $no; ?>">Edit Barang</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="edit-barang.php" method="POST" enctype="multipart/form-data">
                                        <input type="text" name="nama_barang" class="form-control mb-2" maxlength="35" placeholder="Masukkan Nama Barang.." value="<?php echo "$data[nama_barang]"; ?>" required />
                                        <input type="number" name="harga" class="form-control mb-2" maxlength="35" placeholder="Masukkan Harga Barang.." value="<?php echo "$data[harga]"; ?>" required />
                                        <input type="number" name="stok" class="form-control mb-2" maxlength="35" placeholder="Masukkan Stok Barang.." value="<?php echo "$data[stok]"; ?>" required />
                                        <select name="id_kategori" class="form-select mb-2">
                                            <option value="<?php echo "$data[id_kategori]"; ?>"><?php echo "$data[kategori]"; ?></option>
                                            <?php
                                            $d = "select * from kategori where not id_kategori='" . $data['id_kategori'] . "'";
                                            $e = mysqli_query($connect, $d);
                                            while ($f = mysqli_fetch_array($e)) { ?>
                                                <option value="<?php echo "$f[id_kategori]"; ?>"><?php echo "$f[kategori]"; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <input type="hidden" name="id_barang" value="<?php echo "$data[id_barang]"; ?>">
                                        <input type="hidden" name="img" value="<?php echo "$data[gambar]"; ?>">
                                        <center><img src="images/product/<?php echo "$data[gambar]"; ?>" width="100px" height="100px" class="my-3"><br></center>
                                        <label for="gambarEdit<?php echo $no; ?>" class="form-label">Ganti Gambar (opsional)</label>
                                        <input type="file" name="foto" id="gambarEdit<?php echo $no; ?>" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $no++;
                }
                ?>
            </tbody>
        </table>
        <center>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahBarang">Tambah Barang</button>
        </center>
    </div>
    <div class="modal fade" id="TambahBarang" tabindex="-1" aria-labelledby="TambahBarangLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="TambahBarangLabel">Tambah Barang</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="tambah-barang.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="nama_barang" class="form-control mb-2" maxlength="35" placeholder="Masukkan Nama Barang.." required /><br>
                        <input type="number" name="harga" class="form-control mb-2" maxlength="35" placeholder="Masukkan Harga Barang.." required /><br>
                        <input type="number" name="stok" class="form-control mb-2" maxlength="35" placeholder="Masukkan Stok Barang.." required /><br>
                        <select name="id_kategori" class="form-select mb-2">
                            <?php
                            $a = "select * from kategori";
                            $b = mysqli_query($connect, $a);
                            while ($c = mysqli_fetch_array($b)) { ?>
                                <option value="<?php echo "$c[id_kategori]"; ?>"><?php echo "$c[kategori]"; ?></option>
                            <?php }
                            ?>
                        </select><br>
                        <label for="gambarTambah" class="form-label">Pilih Gambar</label>
                        <input type="file" name="gambar" id="gambarTambah" class="form-control" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Tambah">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <center><a href="cetak-barang.php" class="btn btn-success" target="_BLANK">Cetak</a></center>

    <?php
    include "admin-footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tables').DataTable();
        });
    </script>
</body>

</html>