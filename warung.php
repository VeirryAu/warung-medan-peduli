<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  require_once "config.php";

  $nama_warung = $nama_pemilik = $phone_no = $kecamatan = $createdBy = $tanggal_kunjungan = $gambar_warung = $photo_pemilik = "";
  $qty_pesanan = $jumlah_uang = $longitude = $latitude = 0;
  $form_err = "";

  $createdBy = $_SESSION['username'];

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    $nama_warung = $_GET['nama_warung'];
    $nama_pemilik = $_GET['nama_pemilik'];
    $phone_no = $_GET['phone_no'];
    $kecamatan = $_GET['kecamatan'];
    $longitude = $_GET['longitude'];
    $latitude = $_GET['latitude'];
    $tanggal_kunjungan = $_GET['tanggal_kunjungan'];
    $qty_pesanan = $_GET['qty_pesanan'];
    $jumlah_uang = $_GET['jumlah_uang'];
    $createdBy = $_GET['createdBy'];
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
      <?php if (!empty($_GET['message'])) echo "<small id='emailHelp' class='form-text text-muted topnav-center'>" . $_GET['message'] . "</small>"; ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype= "multipart/form-data" method="post">
        <div class="form-group">
          <label onclick="handlePermission" for="nama_warung">Nama Warung</label>
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
          <input type="date" readonly name="tanggal_kunjungan" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="tanggal_kunjungan" placeholder="Masukkan Tanggal Kunjungan">
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
          <input type="file" accept="image/*" name="gambar_warung" class="form-control" id="gambar_warung" placeholder="Masukkan Gambar Warung">
        </div>

        <div class="form-group">
          <label for="photo_pemilik">Photo Pemilik</label>
          <input type="file" accept="image/*" name="photo_pemilik" class="form-control" id="photo_pemilik" placeholder="Masukkan Photo Pemilik">
        </div>

        <div class="form-group">
          <label for="longitude">Longitude</label>
          <input disabled type="text" name="longitude" class="form-control" value="<?php echo $longitude; ?>" id="location" placeholder="Masukkan Longitude">
        </div>

        <div class="form-group">
          <label for="latitude">latitude</label>
          <input disabled type="text" name="latitude" class="form-control" value="<?php echo $latitude; ?>" id="location" placeholder="Masukkan latitude">
        </div>

        <button type="submit" id="submitButton" onclick="handlePermission" class="btn btn-primary">Submit</button>
      </form>
    </div>

    
  <div>
</body>
</html>
