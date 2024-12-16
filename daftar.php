<?php session_start();
if(isset($_SESSION['nama'])){
    $hak = $_SESSION['hak'];
        if($hak == "pengguna"){ ?>
            <script> window.location.href='user/home.php' </script>
        <?php }else if($hak == "admin"){ ?>
            <script> window.location.href='admin/home.php' </script>
        <?php }
    ?>
<?php }
include "conf/connection.php";
 ?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar </title>
    <link href="assets/ico/barley.jpeg" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
    	.flat{
    		border-radius: 0px;
    	}
	</style>
</head>
<body style="background: #ccc;">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                </button>
                <span class="navbar-brand">Bonbon Bakery and Cake<span class="glyphicon glyphicon-shopping-cart"></span></span>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Beranda</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
		<h2 class="page-header">Daftar</h2>
			<form method="POST">
				<div class="form-group">
					<label>Nama</label><br>
					<input type="text"  class="form-control flat" name="nama" maxlength="20" placeholder="Nama" required title="Nama harus berisi character"><br>
					<label>Jenis Kelamin</label>
					<select class="form-control flat" name="jenis_kelamin">
						<option> Laki - Laki </option>
						<option> Perempuan </option>
					</select><br>
					<label>Tanggal Lahir</label><br>
					<input type="date" class="form-control flat" name="tgl_lahir" maxlength="20" required/><br>
					<label>Nama Pengguna</label><br>
					<input type="text" class="form-control flat" name="user" maxlength="20" placeholder="Nama Pengguna" required/><br>
					<label>Kata Sandi</label><br>
					<input type="password" class="form-control flat" name="pass" maxlength="20" placeholder="Kata Sandi" required/>
					<br>
					<button class="btn btn-success flat" type="submit" name="daftar">Daftar</button>
					<a onclick="window.location.href='index.php'" class="btn btn-danger flat"> Batal </a>
				</div>	
			</form>
			<?php
				if(isset($_POST['daftar'])){
					$nama = $_POST['nama'];
					$jenis_kelamin = $_POST['jenis_kelamin'];
					$tgl_lahir = $_POST['tgl_lahir'];
					$user = $_POST['user'];
					$pass = $_POST['pass'];
					$sql = "insert into pengguna(nama,jenis_kelamin,tgl_lahir,username,password,hak) values ('$nama','$jenis_kelamin','$tgl_lahir','$user','$pass','pengguna')";
					$query = mysqli_query($connect, $sql);
					if($query){
						echo "<script> alert('Pendaftaran Berhasil. Silahkan Lakukan Login.'); window.location.href='masuk.php' </script>";
					}else{ ?>
						<div class="alert alert-danger"> Pendaftaran Gagal </div>
					<?php }
				}
			?>
		</div>
		<div class="col-sm-4">
		</div>		
	</div>	
</div>
<div class="register">
    <br><br>
        <div class="container">
            <div class="register-home">
                <p>
                    <a href="index.php" class="btn btn-primary btn=lg">Kembali</a>
                </p>
            </div>
        </div>
</div>
<div class="col-md-12 end-box ">
         &copy; 2021 | All Rights Reserved | Bonbon Bakery and Cake
    </div>
</body>
</html>