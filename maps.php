<?php session_start();
include "conf/connection.php";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Barley Bakery and Cake </title>
    <link href="assets/ico/barley.jpeg" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>         
        .flat{
            border-radius: 0px;
    </style>
</head>
<body>
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
                    <li><a href="index.php"> Beranda </a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="masuk.php">Masuk</a></li>
                    <li><a href="daftar.php">Daftar</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <br><br>
<div class="container">
    <div class="page-header">
        <h1>Alamat Toko Kami <img src="assets/ico/maps.jpg" width="5%" height="5%"></h1>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.0771427915124!2d112.71065561429869!3d-7.117058971767236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd801579a31b0c3%3A0x57c8e86c12c25681!2sJl.%20Nasional%2021%2C%20Perumahan%20Telang%20Perm%2C%20Telang%2C%20Kamal%2C%20Kabupaten%20Bangkalan%2C%20Jawa%20Timur%2069162!5e0!3m2!1sid!2sid!4v1624559152399!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

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
        <br>
    <!--Footer -->
   
   
    <div class="col-md-12 end-box">
        &copy; 2021 | All Rights Reserved | Ndisan - Barley Bakery and Cake
    </div>

    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>