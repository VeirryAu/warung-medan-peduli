<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to index page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // Store data in session variables
    $_SESSION["loggedin"] = false;
    $_SESSION["id"] = null;
    $_SESSION["username"] = null;
    $_SESSION["roleAs"] = null;
    header("location: login");
    exit;
  }
?>