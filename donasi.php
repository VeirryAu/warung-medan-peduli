<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  $nama_donatur = $nomor_rekening = $nilai_donasi = "";
  $form_error = "";

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    // Set parameters
    $nama_donatur = $_GET['nama_donatur'];
    $nomor_rekening = $_GET['nomor_rekening'];
    $nilai_donasi = $_GET['nilai_donasi'];
  }

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "config.php";
    if(empty(trim($_POST["nama_donatur"]))){
      $form_err = "Please enter nama_donatur.";
    } else{
      $nama_donatur = test_input($_POST["nama_donatur"]);
    }

    if(empty(trim($_POST["nomor_rekening"]))){
      $form_err = "Please enter nomor_rekening.";
    } else{
      $nomor_rekening = test_input($_POST["nomor_rekening"]);
    }

    if(empty(trim($_POST["nilai_donasi"]))){
      $form_err = "Please enter nilai_donasi.";
    } else{
      $nilai_donasi = test_input($_POST["nilai_donasi"]);
    }

    if (empty($form_err)) {
      // Prepare a select statement
      $sql = "INSERT INTO tbl_donasi (nama_donatur, nomor_rekening, nilai_donasi, createdBy) VALUES(?,?,?,?)";
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ssss", $param_nama_donatur, $param_nomor_rekening, $param_nilai_donasi, $param_createdBy);
          
          // Set parameters
          $param_nama_donatur = $nama_donatur;
          $param_nomor_rekening = $nomor_rekening;
          $param_nilai_donasi = $nilai_donasi;
          $param_createdBy = $_SESSION["username"];

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
            header("location:donasi.php?message=Success%20Input%20Data%20Donasi");
          } else {
            header("location:donasi.php?message=Gagal%20Input%20Data%20Donasi:$stmt->error&nama_donatur=$nama_donatur&nomor_rekening=$nomor_rekening&nilai_donasi=$nilai_donasi");
          }
              
      }
    } else {
      header("location:donasi.php?message=$form_err&nama_donatur=$nama_donatur&nomor_rekening=$nomor_rekening&nilai_donasi=$nilai_donasi");
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
  <title>Donasi - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
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
      <a href="index.php">
        <img src="/public/logo-new.png" alt="logo" class="image-logo" width="300" height="300" />
      </a>
      <?php if (!empty($_GET['message'])) echo "<small id='emailHelp' class='form-text text-muted topnav-center'>" . $_GET['message'] . "</small>"; ?>
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
