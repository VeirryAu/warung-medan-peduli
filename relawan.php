<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  require_once "config.php";

  $nama_warung = $nama_pemilik = $phone_no = $tanggal_kunjungan = "";
  $qty_pesanan = $jumlah_uang = 0;
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
  <title>Relawan - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
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
          <label for="nama_relawan">Nama Relawan</label>
          <input type="text" name="nama_relawan" class="form-control" value="<?php echo $nama_relawan; ?>" id="nama_relawan" placeholder="Masukkan Nama Relawan">
        </div>

        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" name="nik" class="form-control" value="<?php echo $nik; ?>" id="nik" placeholder="Masukkan NIK">
        </div>

        <div class="form-group">
          <label for="no_hp">No HP</label>
          <input type="text" name="no_hp" class="form-control" value="<?php echo $no_hp; ?>" id="no_hp" placeholder="Masukkan No HP">
        </div>

        <div class="form-group">
          <label for="alamat">Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?php echo $alamat; ?>" id="alamat" placeholder="Masukkan Alamat">
        </div>

        <div class="form-group">
          <label for="instagram">Instagram</label>
          <input type="text" name="instagram" class="form-control" value="<?php echo $instagram; ?>" id="instagram" placeholder="Masukkan Instagram">
        </div>

        <div class="form-group">
          <label for="rekening">Rekening</label>
          <input type="text" name="rekening" class="form-control" value="<?php echo $rekening; ?>" id="rekening" placeholder="Masukkan Rekening">
        </div>

        <div class="form-group">
          <label for="kendaraan">Kendaraan</label>
          <input type="text" name="kendaraan" class="form-control" value="<?php echo $kendaraan; ?>" id="kendaraan" placeholder="Masukkan Kendaraan">
        </div>

        <div class="form-group">
          <label for="relasi">Relasi</label>
          <input type="text" name="relasi" class="form-control" value="<?php echo $relasi; ?>" id="relasi" placeholder="Masukkan Relasi">
        </div>

        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <input type="text" name="jenis_kelamin" class="form-control" value="<?php echo $jenis_kelamin; ?>" id="jenis_kelamin" placeholder="Masukkan Jenis Kelamin">
        </div>
        
        <div class="form-group">
          <label for="umur">Umur</label>
          <input type="text" name="umur" class="form-control" value="<?php echo $umur; ?>" id="umur" placeholder="Masukkan Umur">
        </div>

        <div class="form-group">
          <label for="pekerjaan">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" value="<?php echo $pekerjaan; ?>" id="pekerjaan" placeholder="Masukkan Pekerjaan">
        </div>

        <div class="form-group">
          <label for="available_day">Hari yang tersedia</label>
          <input type="text" name="available_day" class="form-control" value="<?php echo $available_day; ?>" id="available_day" placeholder="Masukkan Hari yang tersedia">
        </div>

        <div class="form-group">
          <label for="photo">Photo</label>
          <input type="file" name="photo" class="form-control" id="photo" placeholder="Masukkan Photo">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    
  <div>
</body>
</html>
