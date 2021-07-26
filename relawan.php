<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }


  $nama_relawan = $nik = $no_hp = $alamat = $instagram = $alamat = $instagram = $rekening = $createdBy = "";
  $kendaraan = $relasi = $jenis_kelamin = $pekerjaan = $available_day = $photo = "";
  $umur = 0;
  $form_error = "";

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    // Set parameters
    $nama_relawan = $_GET['nama_relawan'];
    $nik = $_GET['nik'];
    $no_hp = $_GET['no_hp'];
    $alamat = $_GET['alamat'];
    $instagram = $_GET['instagram'];
    $rekening = $_GET['rekening'];
    $kendaraan = $_GET['kendaraan'];
    $relasi = $_GET['relasi'];
    $jenis_kelamin = $_GET['jenis_kelamin'];
    $umur = $_GET['umur'];
    $pekerjaan = $_GET['pekerjaan'];
    $available_day = $_GET['available_day'];
    $photo = $_GET['photo'];
  }

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "config.php";
    if(empty(trim($_POST["nama_relawan"]))){
      $form_err = "Please enter nama_relawan.";
    } else{
      $nama_relawan = test_input($_POST["nama_relawan"]);
    }

    if(empty(trim($_POST["nik"]))){
      $form_err = "Please enter nik.";
    } else{
      $nik = test_input($_POST["nik"]);
    }
    
    if(empty(trim($_POST["no_hp"]))){
      $form_err = "Please enter no_hp.";
    } else{
      $no_hp = test_input($_POST["no_hp"]);
    }
    
    if(empty(trim($_POST["alamat"]))){
      $form_err = "Please enter alamat.";
    } else{
      $alamat = test_input($_POST["alamat"]);
    }
    
    if(empty(trim($_POST["instagram"]))){
      $form_err = "Please enter instagram.";
    } else{
      $instagram = test_input($_POST["instagram"]);
    }
    
    if(empty(trim($_POST["rekening"]))){
      $form_err = "Please enter rekening.";
    } else{
      $rekening = test_input($_POST["rekening"]);
    }

    if(empty(trim($_POST["kendaraan"]))){
      $form_err = "Please enter kendaraan.";
    } else{
      $kendaraan = test_input($_POST["kendaraan"]);
    }

    if(empty(trim($_POST["relasi"]))){
      $form_err = "Please enter relasi.";
    } else{
      $relasi = test_input($_POST["relasi"]);
    }
    
    if(empty(trim($_POST["jenis_kelamin"]))){
      $form_err = "Please enter jenis_kelamin.";
    } else{
      $jenis_kelamin = test_input($_POST["jenis_kelamin"]);
    }

    if(empty(trim($_POST["umur"]))){
      $form_err = "Please enter umur.";
    } else{
      $umur = test_input($_POST["umur"]);
    }

    if(empty(trim($_POST["pekerjaan"]))){
      $form_err = "Please enter pekerjaan.";
    } else{
      $pekerjaan = test_input($_POST["pekerjaan"]);
    }

    if(count($_POST["available_day"]) == 0 || empty(implode(",", $_POST["available_day"]))){
      $form_err = "Please enter available_day.";
    } else{
      $available_day = implode(",", $_POST["available_day"]);
    }
    
    $target_dir = "uploads/photo/" . date("YMd") . "/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $file_name = basename($_FILES["photo"]['name']);
    $target_file = $target_dir . uniqid() . '.' . strtolower(pathinfo($file_name,PATHINFO_EXTENSION));


    $uploadOk = 1;

    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check === false) {
      $form_err = "File is not an image.";
      $uploadOk = 0;
    }



    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $form_err = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $form_err = "Sorry, there was an error uploading your file. photo";
      } else {
        $photo = $target_file;
      }
    }

    if (empty($form_err)) {
      // Prepare a select statement
      $sql = "INSERT INTO tbl_relawan (nama_relawan, nik, no_hp, alamat, instagram, rekening, kendaraan, relasi, jenis_kelamin, umur, pekerjaan, available_day, photo, createdBy) VALUES(?,?,?,?,?, ?,?,?,?,?, ?,?,?,?)";
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ssssssssssssss", $param_nama_relawan, $param_nik, $param_no_hp, $param_alamat, $param_instagram, $param_rekening, $param_kendaraan, $param_relasi, $param_jenis_kelamin, $param_umur, $param_pekerjaan, $param_available_day, $param_photo, $param_createdBy);
          
          // Set parameters
          $param_nama_relawan = $nama_relawan;
          $param_nik = $nik;
          $param_no_hp = $no_hp;
          $param_alamat = $alamat;
          $param_instagram = $instagram;
          $param_rekening = $rekening;
          $param_kendaraan = $kendaraan;
          $param_relasi = $relasi;
          $param_jenis_kelamin = $jenis_kelamin;
          $param_umur = $umur;
          $param_pekerjaan = $pekerjaan;
          $param_available_day = $available_day;
          $param_createdBy = $_SESSION["username"];
          $param_photo = $target_file;

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
            header("location:relawan.php?message=Success%20Input%20Data%20Relawan");
          } else {
            header("location:relawan.php?message=Gagal%20Input%20Data%20Relawan:$stmt->error&&nama_relawan=$nama_relawan&nik=$nik&no_hp=$no_hp&alamat=$alamat&instagram=$instagram&rekening=$rekening&kendaraan=$kendaraan&relasi=$relasi&jenis_kelamin=$jenis_kelamin&umur=$umur&pekerjaan=$pekerjaan&available_day=$available_day&photo=$photo");
          }
              
      }
    } else {
      header("location:relawan.php?message=$form_err&nama_relawan=$nama_relawan&nik=$nik&no_hp=$no_hp&alamat=$alamat&instagram=$instagram&rekening=$rekening&kendaraan=$kendaraan&relasi=$relasi&jenis_kelamin=$jenis_kelamin&umur=$umur&pekerjaan=$pekerjaan&available_day=$available_day&photo=$photo");
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
  <?php include "css.php" ?>
  <?php include "js.php" ?>
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
      <a href="index">
        <img src="/public/logo-new.png" class="image-logo" />
      </a>
      <?php if (!empty($_GET['message'])) echo "<small id='emailHelp' class='form-text text-muted topnav-center'>" . $_GET['message'] . "</small>"; ?>
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
          <label for="rekening">Bank/Nomor Rekening/Nama Rekening</label>
          <input type="text" name="rekening" class="form-control" value="<?php echo $rekening; ?>" id="rekening" placeholder="contoh: BCA/20991009912/Andy Wil">
        </div>

        <div class="form-group">
          <label for="kendaraan">Kendaraan</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="Mobil" name="kendaraan" id="kendaraan1" checked>
            <label class="form-check-label" for="kendaraan1">
              Mobil
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="Motor" name="kendaraan" id="kendaraan2" >
            <label class="form-check-label" for="kendaraan2">
              Sepeda Motor
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="Tidak ada" name="kendaraan" id="kendaraan3" >
            <label class="form-check-label" for="kendaraan3">
              Tidak ada
            </label>
          </div>
        </div>

        <div class="form-group">
          <label for="relasi">Tim relawan yang saya kenal</label>
          <input type="text" name="relasi" class="form-control" aria-describedby="relasiHelp"  value="<?php echo $relasi; ?>" id="relasi" placeholder="contoh: Andy,Budi,Jimmy">
          <small id="relasiHelp" class="form-text text-muted">akan digunakan dalam pengaturan tim</small>
        </div>

        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="jenis_kelamin" id="jenis_kelamin1" checked>
            <label class="form-check-label" for="jenis_kelamin1">
              Pria
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" value="0" name="jenis_kelamin" id="jenis_kelamin2">
            <label class="form-check-label" for="jenis_kelamin2">
              Wanita
            </label>
          </div>
        </div>
        
        <div class="form-group">
          <label for="umur">Umur</label>
          <input type="number"  min="17" max="60" name="umur" class="form-control" value="<?php echo $umur === 0 ? 17 : $umur; ?>" id="umur" placeholder="Masukkan Umur">
        </div>

        <div class="form-group">
          <label for="pekerjaan">Pekerjaan</label>
          <input type="text" name="pekerjaan" class="form-control" value="<?php echo $pekerjaan; ?>" id="pekerjaan" placeholder="Masukkan Pekerjaan">
        </div>

        <div class="form-group">
          <label for="available_day">Hari yang tersedia</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="available_day[]" id="available_day1">
            <label class="form-check-label" for="available_day1">
              Senin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="2" name="available_day[]" id="available_day2">
            <label class="form-check-label" for="available_day2">
              Selasa
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="3" name="available_day[]" id="available_day3">
            <label class="form-check-label" for="available_day3">
              Rabu
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="4" name="available_day[]" id="available_day4">
            <label class="form-check-label" for="available_day4">
              Kamis
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="5" name="available_day[]" id="available_day5">
            <label class="form-check-label" for="available_day5">
              Jumat
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="6" name="available_day[]" id="available_day6">
            <label class="form-check-label" for="available_day6">
              Sabtu
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="7" name="available_day[]" id="available_day7">
            <label class="form-check-label" for="available_day7">
              Minggu
            </label>
          </div>
        </div>

        <div class="form-group">
          <label for="photo">Photo</label>
          <input type="file" accept="image/*" name="photo" class="form-control" id="photo" placeholder="Masukkan Photo Selfie">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    
  <div>
</body>
</html>
