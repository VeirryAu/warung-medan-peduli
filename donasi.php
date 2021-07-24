<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  require_once "config.php";

  $nama_warung = $nama_pemilik = $phone_no = $tanggal_kunjungan = "";
  $qty_pesanan = $jumlah_uang = $nilai_donasi = 0;
  $form_error = "";

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donasi - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
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
          <label for="nama_donatur">Nama Donatur</label>
          <input type="text" name="nama_donatur" class="form-control" value="<?php echo $nama_donatur; ?>" id="nama_donatur" placeholder="Masukkan Nama Donatur">
        </div>

        <div class="form-group">
          <label for="nomor_rekening">Nomor Rekening</label>
          <input type="text" name="nomor_rekening" class="form-control" value="<?php echo $nomor_rekening; ?>" id="nomor_rekening" placeholder="Masukkan Nomor Rekening">
        </div>

        <div class="form-group">
          <label for="nilai_donasi">Nilai Donasi</label>
          <input type="number" name="nilai_donasi" class="form-control" value="<?php echo $nilai_donasi; ?>" id="nilai_donasi" placeholder="Masukkan Nilai Donasi">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    
  <div>
</body>
</html>
