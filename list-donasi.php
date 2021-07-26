<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login");
    exit;
  }

  $list = array();

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    require_once "config";

    $sql = "SELECT id, nama_donatur, nomor_rekening, nilai_donasi FROM tbl_donasi ORDER BY id DESC LIMIT 400";

    if($stmt = mysqli_query($link, $sql)){
      while ($row = mysqli_fetch_assoc($stmt)) {
        $list[] = $row;
      }
    }


    mysqli_close($link);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Donasi - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
  <?php include 'css'; ?>
  <?php include 'js'; ?>
</head>
<style>
a, a:hover, a:focus, a:active {
  text-decoration: none;
  color: inherit;
}
</style>
<body class="body white">
  <?php include 'header';getHeader(); ?>
  <div class="container grid-container mt-4">
    <div class="grid-container-layout">
      <?php
        foreach ($list as $key => $value) {
      ?>
      <div class="card p-2" style="width: 100%;">
        <div class="">
          <?php if ($_SESSION["roleAs"] == "admin" || $_SESSION["roleAs"] == "superadmin") { ?>
            <a href="#" style="padding:4px 10px;margin:0 10px;" class="btn btn-danger topnav-right">Delete</a>
          <?php } ?>
          <h5 class="card-title" style="padding:4px 0px;margin:0px;margin-top:10px">XXXX</h5>
          <p class="card-text" style="padding:4px 0px;margin:4px 0px;"><?php echo $value['nilai_donasi']; ?></p>
        </div>
        
      </div>
      <?php
        }
      ?>
    </div>

    
  <div>
</body>
</html>
