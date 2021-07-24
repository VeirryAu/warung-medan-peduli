<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  require_once "config.php";

  $nama_warung = $nama_pemilik = $phone_no = $kecamatan = $tanggal_kunjungan = "";
  $qty_pesanan = $jumlah_uang = $longitude = $latitude = 0;
  $form_error = "";

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $target_dir = "uploads/photo_pemilik/" . date("YMd") . "/";
    $file_name = basename($_FILES["photo_pemilik"]["name"]);
    $target_file = $target_dir . strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

    $uploadOk = 1;

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $form_error = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["photo_pemilik"]["tmp_name"], $target_file)) {
        $form_error = "Sorry, there was an error uploading your file.";
      }
    }

    $target_dir = "uploads/gambar_warung/" . date("YMd") . "/";
    $file_name = basename($_FILES["gambar_warung"]["name"]);
    $target_file = $target_dir . uniqid() . pathinfo($file_name, PATHINFO_EXTENSION);
    
    $uploadOk2 = 1;
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk1 != 0 && $uploadOk2 == 0) {
      $form_error = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["gambar_warung"]["tmp_name"], $target_file)) {
        $form_error = "Sorry, there was an error uploading your file.";
      }
    }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Warung - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
          <label for="nama_warung">Nama Warung</label>
          <input type="text" name="nama_warung" class="form-control" value="<?php echo $nama_warung; ?>" id="nama_warung" placeholder="Masukkan Nama Warung">
        </div>

        <div class="form-group">
          <label for="nama_pemilik">Nama Pemilik</label>
          <input type="text" name="nama_pemilik" class="form-control" value="<?php echo $nama_pemilik; ?>" id="nama_pemilik" placeholder="Masukkan Nama Pemilik">
        </div>

        <div class="form-group">
          <label for="phone_no">Nomor HP</label>
          <input type="text" name="phone_no" class="form-control" value="<?php echo $phone_no; ?>" id="phone_no" placeholder="Masukkan Nomor HP">
        </div>

        <div class="form-group">
          <label for="kecamatan">Kecamatan</label>
          <input type="text" name="kecamatan" class="form-control" value="<?php echo $kecamatan; ?>" id="kecamatan" placeholder="Masukkan Kecamatan">
        </div>

        <div class="form-group">
          <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
          <input type="date" disabled name="tanggal_kunjungan" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="tanggal_kunjungan" placeholder="Masukkan Tanggal Kunjungan">
        </div>

        <div class="form-group">
          <label for="qty_pesanan">QTY Pesanan</label>
          <input type="number" name="qty_pesanan" class="form-control" value="<?php echo $qty_pesanan; ?>" id="qty_pesanan" placeholder="Masukkan QTY Pesanan">
        </div>
        
        <div class="form-group">
          <label for="jumlah_uang">Jumlah Uang</label>
          <input type="number" name="jumlah_uang" class="form-control" value="<?php echo $jumlah_uang; ?>" id="jumlah_uang" placeholder="Masukkan Jumlah Uang">
        </div>

        <div class="form-group">
          <label for="gambar_warung">Gambar Warung</label>
          <input type="file" name="gambar_warung" class="form-control" id="gambar_warung" placeholder="Masukkan Gambar Warung">
        </div>

        <div class="form-group">
          <label for="photo_pemilik">Photo Pemilik</label>
          <input type="file" name="photo_pemilik" class="form-control" id="photo_pemilik" placeholder="Masukkan Photo Pemilik">
        </div>

        <div class="form-group">
          <label for="longitude">Longitude</label>
          <input disabled type="text" name="longitude" class="form-control" value="<?php echo $longitude; ?>" id="location" placeholder="Masukkan Longitude">
        </div>

        <div class="form-group">
          <label for="latitude">latitude</label>
          <input disabled type="text" name="latitude" class="form-control" value="<?php echo $latitude; ?>" id="location" placeholder="Masukkan latitude">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    
  <div>
</body>
<script>
  $(document).ready(function () {
    function onPositionUpdate(position)
    {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        $('#longitude').val(position.coords.longitude);
        $('#latitude').val(position.coords.latitude);
    }

    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onPositionUpdate);
    } else {
      alert("navigator.geolocation is not available");
    }
  })
</script>
</html>
