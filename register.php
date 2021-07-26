<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to index page
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  if ($_SESSION["roleAs"] != "superadmin") {
    header("location: index.php");
    exit;
  }


  $username = $password = $fullName = $roleAs = "";
  $form_err = "";
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $username = $_GET['username'];
    $fullName = $_GET['fullName'];
    $roleAs = $_GET['roleAs'];
  }


  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "config.php";
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $form_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["fullName"]))){
        $form_err = "Please enter fullName.";
    } else{
        $fullName = trim($_POST["fullName"]);
    }

    if(empty(trim($_POST["roleAs"]))){
      $form_err = "Please enter roleAs.";
  } else{
      $roleAs = trim($_POST["roleAs"]);
  }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $form_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($form_err)){
        // Prepare a select statement
        $sql = "INSERT INTO tbl_user (username, fullName, roleAs, `password`) VALUES(?,?,?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_fullName, $param_roleAs, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_fullName = $fullName;
            $param_roleAs = $roleAs;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              header("location: register.php?message=Success%20Create%20User");
            } else {
              header("location: register.php?message=Gagal%20Create%20User&username=$username&fullName=$fullName&roleAs=$roleAs");
            }
                
        }
    } else {
      header("location: register.php?message=$form_err&username=$username&fullName=$fullName&roleAs=$roleAs");
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
  <title>Register - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
  <?php include "css.php" ?>
  <?php include "js.php" ?>
</head>
<body class="body red">
  <div class="wrapper red">
    <div class="container login">
      <a href="index">
        <img src="/public/logo-new.png" class="image-logo" />
      </a>
    </div>

    <?php if (!empty($_GET['message'])) echo "<small id='emailHelp' class='form-text text-muted topnav-center'>" . $_GET['message'] . "</small>"; ?>

    <form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
        <label for="roleAs">Role As</label>
        <select class="form-control" id="roleAs" name="roleAs">
            <option selected value="superadmin" style="color:#212121;">Super Admin</option>
            <option value="admin" style="color:#212121;">Admin</option>
            <option value="user" style="color:#212121;">User</option>
        </select>
      </div>

      <div class="form-group">
        <label for="username">Nomor HP</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" id="username" placeholder="Masukkan Nomor HP">
      </div>

      <div class="form-group">
        <label for="fullName">Nama Lengkap</label>
        <input type="text" name="fullName" autocomplete="nope" class="form-control" value="<?php echo $fullName; ?>" id="fullName" placeholder="Masukkan Nama Lengkap">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="passowrd" placeholder="Password" autocomplete="new-password">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  <div>
</body>

</html>
