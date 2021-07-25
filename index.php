<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
  <?php include 'css.php'; ?>
  <?php include 'js.php'; ?>
</head>
<style>
a, a:hover, a:focus, a:active {
  text-decoration: none;
  color: inherit;
}
</style>
<body class="body red">
  <div class="wrapper red">
      <a href="logout.php" class="topnav-right">Log Out</a>
      <?php 
        if ($_SESSION["roleAs"] == "superadmin") {
      ?>
        <?php include 'header.php';getHeader(); ?>
      <?php }?>
      <?php 
        if ($_SESSION["roleAs"] == "admin") {
      ?>
        <a href="admin.php" class="topnav-left">Admin</a>
      <?php }?>
      <div class="container login">

      <a href="index.php">
        <img src="/public/logo-new.png" class="image-logo" />
      </a>
      <a class="link-ref" href="donasi.php">
      <div class="home-content-title">Total Donasi</div>
      <div class="home-content-value">641.088.000</div>
      <div class="home-content-description">rupiah <br/> updated 25 Juli 2021, 6:38 PM</div>
      </a>

      <a class="link-ref" href="warung.php">
      <div class="home-content-title">Total warung yang terbantu</div>
      <div class="home-content-value">129</div>
      <div class="home-content-description">warung</div>
      </a>

      <div class="home-content-title">Total makanan yang dibagikan</div>
      <div class="home-content-value">6.450</div>
      <div class="home-content-description">paket</div>
      <a class="link-ref" href="relawan.php">
        <div class="home-content-title">Jadi Relawan</div>
      </a>
    </div>

    
  <div>
</body>
</html>
