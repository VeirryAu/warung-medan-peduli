<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  $list = array();

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    require_once "config.php";

    if (!empty($_GET['id'])) {
      $sql = "SELECT id, nama_relawan, nik, no_hp, alamat, instagram, rekening, kendaraan, relasi, jenis_kelamin, umur, pekerjaan, available_day, photo, createdAt FROM tbl_relawan WHERE id = ? ORDER BY id DESC LIMIT 1";
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $_GET['id'];
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $id, $nama_relawan, $nik, $no_hp, $alamat, $instagram, $rekening, $kendaraan, $relasi, $jenis_kelamin, $umur, $pekerjaan, $available_day, $photo, $createdAt);
            if(mysqli_stmt_fetch($stmt)){

            }
          }
        } else {
        }
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
  <title>Detail Relawan <?php echo $nama_relawan ?> - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
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
  <?php include 'header.php';getHeader(); ?>
  <div class="container grid-container mt-4">
      <?php if (!empty($_GET['message'])) echo "<small id='emailHelp' class='form-text text-primary topnav-center'>" . $_GET['message'] . "</small>"; ?>
    <div class="" style="width: 100%;">
        <div class="row">
          <div class="col-4">
            <img class="image-warung-detail" style="padding-left:5px;object-fit: contain;" width="100%" height="120" src="/<?php echo $photo; ?>" alt="<?php echo $nama_relawan; ?>">
          </div>
          <div class="col-8">
            <div class="">
              <h5 class="card-title" style="padding:4px 0px;margin:0px;margin-top:10px"><?php echo $nama_relawan; ?></h5>
              <p class="card-text" style="font-weight:thin;padding:4px 0px;margin:4px 0px;">
              </p>
              <?php if (!empty($instagram)) { ?>
              <p class="card-text" style="font-weight:thin;padding:4px 0px;margin:4px 0px;">
              <?php echo "Instagram: @" . str_replace("@", "", $instagram); ?><br />
              </p>
              <?php } ?>
              <p class="card-text" style="font-weight:thin;padding:4px 0px;margin:4px 0px;">
              <?php echo "Joined: " . date("d M Y", strtotime($createdAt)); ?><br />
              </p>
            </div>
          </div>
        
      </div>
    </div>
  <div>

</body>
</html>
