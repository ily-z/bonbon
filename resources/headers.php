<?php
include_once 'conf/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bonbon Bakery and Cakes</title>
    <link href="assets/ico/barley.jpeg" rel="shortcut icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/bootstrap.min.js">
     
    <!-- alpine cnd -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs/dist/cdn.min.js"></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        // import Alpine from 'alpinejs'
        // import intersect from '@alpinejs/intersect'
        // Alpine.plugin(intersect)
        // window.Alpine = Alpine
        // Alpine.start()
    </script>
    <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet"/>
    
    <style>
@import url('https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300..900&display=swap');
</style>
    <style>

        .product-box {
      background: url('images/content/dark-texture-produk.png') center/cover no-repeat;
      color: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      position: relative;
    }
    .product-box img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
    }
    .product-box-button {
      background-color: #C9AA7B;
      border: none;
      padding: 8px 12px;
      color: white;
      font-weight: bold;
      border-radius: 5px;
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 1;
    }
    .product-box form {
      position: relative;
    }
    .product-box .form-control[type=number] {
      width: 80px;
      margin-bottom: 10px;
    }
        .flat{
            border-radius: 0px;
        }
    </style>
</head>