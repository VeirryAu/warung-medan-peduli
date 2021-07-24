<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  require_once "config.php";

  $nama_warung = $nama_pemilik = $phone_no = $tanggal_kunjungan = "";
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
    if(empty(trim($_POST["nama_warung"]))){
        $form_error = "Please enter nama_warung.";
    } else{
        $nama_warung = trim($_POST["nama_warung"]);
    }

    if(empty(trim($_POST["nama_pemilik"]))){
      $form_error = "Please enter nama_pemilik.";
    } else{
        $nama_pemilik = trim($_POST["nama_pemilik"]);
    }

    if(empty(trim($_POST["tanggal_kunjungan"]))){
      $form_error = "Please enter tanggal_kunjungan.";
    } else{
        $tanggal_kunjungan = trim($_POST["tanggal_kunjungan"]);
    }

    if(empty(trim($_POST["qty_pesanan"])) || trim($_POST["qty_pesanan"]) == 0){
      $form_error = "Please enter qty_pesanan.";
    } else{
      $qty_pesanan = trim($_POST["qty_pesanan"]);
    }

    if(empty(trim($_POST["jumlah_uang"])) || trim($_POST["jumlah_uang"]) == 0){
      $form_error = "Please enter jumlah_uang.";
    } else{
      $jumlah_uang = trim($_POST["jumlah_uang"]);
    }
    
    // Validate credentials
    if(empty($form_error)){
        // Prepare a select statement
        $sql = "INSERT INTO tbl_warung (nama_warung, nama_pemilik, phone_no, tanggal_kunjungan, qty_pesanan, jumlah_uang)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssii", $param_nama_warung, $param_nama_pemilik, $param_phone_no, $param_tanggal_kunjungan, $param_qty_pesanan, $jumlah_uang);
            
            $nama_warung = $nama_warung;
            $param_nama_pemilik = $nama_pemiliks;
            $param_phone_no = $phone_nos;
            $param_tanggal_kunjungan = $tanggal_kunjungans;
            $param_qty_pesanan = $qty_pesanans;
            $param_jumlah_uang = $jumlah_uangs;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($password == $hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to index page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
          <label for="nama_warung">Nama Warung</label>
          <input type="text" name="nama_warung" class="form-control" value="<?php echo $nama_warung; ?>" id="nama_warung" placeholder="Masukkan Nama Warung">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="nama_pemilik">Nama Pemilik</label>
          <input type="text" name="nama_pemilik" class="form-control" value="<?php echo $nama_pemilik; ?>" id="nama_pemilik" placeholder="Masukkan Nama Pemilik">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="phone_no">Nomor HP</label>
          <input type="text" name="phone_no" class="form-control" value="<?php echo $phone_no; ?>" id="phone_no" placeholder="Masukkan Nomor HP">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="kecamatan">Kecamatan</label>
          <input type="text" name="kecamatan" class="form-control" value="<?php echo $kecamatan; ?>" id="kecamatan" placeholder="Masukkan Kecamatan">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
          <input type="text" name="tanggal_kunjungan" class="form-control" value="<?php echo $tanggal_kunjungan; ?>" id="tanggal_kunjungan" placeholder="Masukkan Tanggal Kunjungan">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="qty_pesanan">QTY Pesanan</label>
          <input type="number" name="qty_pesanan" class="form-control" value="<?php echo $qty_pesanan; ?>" id="qty_pesanan" placeholder="Masukkan QTY Pesanan">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>
        
        <div class="form-group">
          <label for="jumlah_uang">Jumlah Uang</label>
          <input type="number" name="jumlah_uang" class="form-control" value="<?php echo $jumlah_uang; ?>" id="jumlah_uang" placeholder="Masukkan Jumlah Uang">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="gambar_warung">Gambar Warung</label>
          <input type="file" name="gambar_warung" class="form-control" id="gambar_warung" placeholder="Masukkan Gambar Warung">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="photo_pemilik">Photo Pemilik</label>
          <input type="file" name="photo_pemilik" class="form-control" id="photo_pemilik" placeholder="Masukkan Photo Pemilik">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="longitude">Longitude</label>
          <input disabled type="text" name="longitude" class="form-control" value="<?php echo $longitude; ?>" id="location" placeholder="Masukkan Longitude">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <div class="form-group">
          <label for="latitude">latitude</label>
          <input disabled type="text" name="latitude" class="form-control" value="<?php echo $latitude; ?>" id="location" placeholder="Masukkan latitude">
          <!-- <small id="emailHelp" class="form-text text-muted">Didaftarkan oleh admin</small> -->
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    
  <div>
</body>
</html>
