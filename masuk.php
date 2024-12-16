<?php session_start();

 
include "conf/connection.php";
 ?>

<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Masuk </title>
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
		<h2 class="page-header">Masuk</h2>
			<form method="POST">
				<div class="form-group">
					<label>Nama Pengguna</label><br>
					<input type="text" class="form-control flat" name="user" placeholder="Nama Pengguna" maxlength="30" required/><br>
					<label>Kata Sandi</label><br>
					<input type="password" class="form-control flat" name="pass" placeholder="Kata Sandi" maxlength="20" required/>
					<br>
					<button class="btn btn-warning flat" type="submit" name="login">Masuk</button> Atau <a href="daftar.php" class="btn btn-default flat">Daftar</a>
				</div>	
			</form>
			<?php
			if(isset($_POST['login'])){
				$user = $_POST['user'];
				$pass = $_POST['pass'];
				$sql = "select * from pengguna where username='$user' and password='$pass'";
				$query = mysqli_query($connect, $sql);
				$data = mysqli_fetch_array($query);
				$cek = mysqli_num_rows($query);
				$nama = $data['nama'] ?? null;
				$hak = $data['hak'] ?? null;
				$id = $data['id_pengguna'] ?? null;
				if($cek > 0){ 
					if($hak == "pengguna"){ 
							$_SESSION['nama'] = $nama;
							$_SESSION['hak'] = $hak;
							$_SESSION['id'] = $id;
						?>
						<script> window.location.href='user/home.php' </script>
				<?php }else if($hak == "admin"){ 
							$_SESSION['nama'] = $nama;
							$_SESSION['hak'] = $hak;
							$_SESSION['id'] = $id;
						?>
						<script> window.location.href='admin/home.php' </script>
				<?php }
				}else{ ?>
					<div class="alert alert-danger"> Login Gagal </div>
				<?php } 
			} ?>
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
         &copy; 2024 | All Rights Reserved | Bonbon Bakery and Cake
    </div>
</body>
</html>