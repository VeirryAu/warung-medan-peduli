<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  $list = array();

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    require_once "config.php";

    $sql = "SELECT id, nama_warung, nama_pemilik, phone_no, kecamatan, tanggal_kunjungan, qty_pesanan, jumlah_uang, nama_menu, alamat, gambar_warung, photo_pemilik FROM tbl_warung ORDER BY id DESC LIMIT 400";

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
    <div class="container login">
      <a href="index.php">
        <img src="/public/logo-new.png" class="image-logo" />
      </a>
      <?php
        foreach ($list as $key => $value) {
      ?>
      <div class="card" style="width: 100%;">
        <div class="row">
          <div class="col-4">
            <img class="card-img-top" src="/<?php echo $value['gambar_warung']; ?>" alt="<?php echo $value['nama_warung']; ?>">
          </div>
          <div class="col-8">
            <div class="">
              <?php if ($_SESSION["roleAs"] == "admin" || $_SESSION["roleAs"] == "superadmin") { ?>
                <a href="#" style="padding:4px 10px;margin:0 10px;"" class="btn btn-danger topnav-right">Delete</a>
              <?php } ?>
              <h5 class="card-title" style="padding:4px 0px;margin:0px;margin-top:10px"><?php echo $value['nama_warung']; ?></h5>
              <p class="card-text" style="padding:4px 0px;margin:4px 0px;"><?php echo $value['alamat']; ?></p>
              <p class=""><?php echo $value['tanggal_kunjungan']; ?></p>
            </div>
          </div>
        </div>
        
      </div>
      <?php
        }
      ?>
    </div>

    
  <div>
</body>
</html>
