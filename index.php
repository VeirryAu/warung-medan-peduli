<?php
  // session_start();

  // // Check if the user is already logged in, if yes then redirect him to welcome page
  // if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
  //   header("location: login.php");
  //   exit;
  // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
  <?php include "css.php" ?>
  <?php include "js.php" ?>
</head>
<style>
a, a:hover, a:focus, a:active {
  text-decoration: none;
  color: inherit;
}
</style>
<body class="body white">
  <div class="text-primary">
      <?php 
        // if ($_SESSION["roleAs"] == "superadmin") {
      ?>
        <?php include 'header.php';getHeader(); ?>
      <?php 
    // }
    ?>
      <?php 
        if ($_SESSION["roleAs"] == "admin") {
      ?>
        <a href="admin.php" class="topnav-left">Admin</a>
      <?php }?>
      <div class="container login">

      <a href="index.php">
        <img src="public/logo-new.png" alt="logo" class="image-logo" width="300" height="300" />
      </a>
      <div class="grid-container-layout">
        <div class="jumbotron mx-2">
          <a class="link-ref" href="list-donasi.php">
          <div class="home-content-title">Total Donasi</div>
          <div class="home-content-value">863.592.713</div>
          <div class="home-content-description">rupiah <br/> updated 25 Juli 2021, 03:40 PM</div>
          </a>
        </div>
        <div class="jumbotron mx-2">
          <a class="link-ref" href="list-warung.php">
          <div class="home-content-title">Total warung yang terbantu</div>
          <div class="home-content-value">152</div>
          <div class="home-content-description">warung</div>
          </a>
        </div>

        <div class="jumbotron mx-2">
          <div class="home-content-title">Total makanan yang dibagikan</div>
          <div class="home-content-value">7.600</div>
          <div class="home-content-description">paket</div>
        </div>
      </div>
      <a class="link-ref" target="__blank" href="https://bit.ly/RelawanWarungMedanPeduli">
        <div class="home-content-title bg-danger text-white btn">Jadi Relawan</div>
      </a>

    </div>

    
  <div>
</body>
</html>
