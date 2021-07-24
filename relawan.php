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
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "config.php";
    if(empty(trim($_POST["nama_pemilik"]))){
      $form_err = "Please enter nama_pemilik.";
    } else{
      $nama_pemilik = test_input($_POST["nama_pemilik"]);
    }

    if(empty(trim($_POST["nama_warung"]))){
      $form_err = "Please enter nama_warung.";
    } else{
      $nama_warung = test_input($_POST["nama_warung"]);
    }
    
    if(empty(trim($_POST["phone_no"]))){
      $form_err = "Please enter phone_no.";
    } else{
      $phone_no = test_input($_POST["phone_no"]);
    }

    if(empty(trim($_POST["kecamatan"]))){
      $form_err = "Please enter kecamatan.";
    } else{
      $kecamatan = test_input($_POST["kecamatan"]);
    }

    if(empty(trim($_POST["qty_pesanan"]))){
      $form_err = "Please enter qty_pesanan.";
    } else{
      $qty_pesanan = test_input($_POST["qty_pesanan"]);
    }

    if(empty(trim($_POST["jumlah_uang"]))){
      $form_err = "Please enter jumlah_uang.";
    } else{
      $jumlah_uang = test_input($_POST["jumlah_uang"]);
    }

    if(empty(trim($_POST["tanggal_kunjungan"]))){
      $form_err = "Please enter tanggal_kunjungan.";
    } else{
      $tanggal_kunjungan = test_input($_POST["tanggal_kunjungan"]);
    }
    
    $target_dir = "uploads/photo_pemilik/" . date("YMd") . "/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $file_name = basename($_FILES["photo_pemilik"]['name']);
    $target_file = $target_dir . uniqid() . '.' . strtolower(pathinfo($file_name,PATHINFO_EXTENSION));


    $uploadOk = 1;

    $check = getimagesize($_FILES["photo_pemilik"]["tmp_name"]);
    if($check === false) {
      $form_err = "File is not an image.";
      $uploadOk = 0;
    }



    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $form_err = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["photo_pemilik"]["tmp_name"], $target_file)) {
        $form_err = "Sorry, there was an error uploading your file. photo_pemilik";
      } else {
        $photo_pemilik = $target_file;
      }
    }

    $target_dir = "uploads/gambar_warung/" . date("YMd") . "/";
    if (!file_exists($target_dir)) {
      mkdir($target_dir, 0777, true);
    }
    $file_name = basename($_FILES["gambar_warung"]['name']);
    $target_file2 = $target_dir . uniqid() . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
    
    $uploadOk2 = 1;

    $check = getimagesize($_FILES["gambar_warung"]["tmp_name"]);
    if($check === false) {
      $form_err = "File is not an image.";
      $uploadOk2 = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk != 0 && $uploadOk2 == 0) {
      $form_err = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["gambar_warung"]["tmp_name"], $target_file2)) {
        $form_err = "Sorry, there was an error uploading your file. gambar_warung";
      } else {
        $gambar_warung = $target_file2;
      }
    }

    if($uploadOk != 0){
      $gambar_warung = test_input($_POST["gambar_warung"]);
    }

    if($uploadOk2 != 0){
      $photo_pemilik = test_input($_POST["photo_pemilik"]);
    }

    if (empty($form_err)) {
      // Prepare a select statement
      $sql = "INSERT INTO tbl_warung (nama_warung, nama_pemilik, phone_no, kecamatan, longitude, latitude, tanggal_kunjungan, qty_pesanan, jumlah_uang, createdBy, gambar_warung, photo_pemilik) VALUES(?,?,?, ?,?,?, ?,?,?, ?,?,?)";
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ssssiisiisss", $param_nama_warung, $param_nama_pemilik, $param_phone_no, $param_kecamatan, $param_longitude, $param_latitude, $param_tanggal_kunjungan, $param_qty_pesanan, $param_jumlah_uang, $param_createdBy, $param_gambar_warung, $param_photo_pemilik);
          
          // Set parameters
          $param_nama_warung = $nama_warung;
          $param_nama_pemilik = $nama_pemilik;
          $param_phone_no = $phone_no;
          $param_kecamatan = $kecamatan;
          $param_longitude = $longitude;
          $param_latitude = $latitude;
          $param_tanggal_kunjungan = $tanggal_kunjungan;
          $param_qty_pesanan = $qty_pesanan;
          $param_jumlah_uang = $jumlah_uang;
          $param_createdBy = $_SESSION["username"];
          $param_gambar_warung = $target_file2;
          $param_photo_pemilik = $target_file;

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
            header("location:warung.php?message=Success%20Input%20Data%20Warung");
          } else {
            header("location:warung.php?message=Gagal%20Input%20Data%20Warung&&nama_warung=$nama_warung&nama_pemilik=$nama_pemilik&phone_no=$phone_no&kecamatan=$kecamatan&longitude=$longitude&latitude=$latitude&tanggal_kunjungan=$tanggal_kunjungan&qty_pesanan=$qty_pesanan&jumlah_uang=$jumlah_uang&createdBy=$createdBy&gambar_warung=$gambar_warung&photo_pemilik=$photo_pemilik");
          }
              
      }
    } else {
      header("location:warung.php?message=$form_err&nama_warung=$nama_warung&nama_pemilik=$nama_pemilik&phone_no=$phone_no&kecamatan=$kecamatan&longitude=$longitude&latitude=$latitude&tanggal_kunjungan=$tanggal_kunjungan&qty_pesanan=$qty_pesanan&jumlah_uang=$jumlah_uang&createdBy=$createdBy&gambar_warung=$gambar_warung&photo_pemilik=$photo_pemilik");
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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype= "multipart/form-data" method="post">
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
