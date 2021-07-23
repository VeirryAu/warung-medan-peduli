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
  <title>Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
  <?php include 'css.php'; ?>
  <?php include 'js.php'; ?>
</head>
<body class="body red">
  <div class="wrapper red">
    <div class="container login">
      <img src="/public/logo-new.png" class="image-logo" />
      <div class="home-content-title">Total Donasi</div>
      <div class="home-content-value">641.088.000</div>
      <div class="home-content-description">rupiah <br/> updated 25 Juli 2021, 6:38 PM</div>

      <div class="home-content-title">Total warung yang terbantu</div>
      <div class="home-content-value">129</div>
      <div class="home-content-description">warung</div>

      <div class="home-content-title">Total makanan yang dibagikan</div>
      <div class="home-content-value">6.450</div>
      <div class="home-content-description">paket</div>
    </div>

    
  <div>
</body>

<script>
  $(document).ready(function () {
     
  })
</script>

</html>
