<?php
  if($_SERVER["REQUEST_METHOD"] =="POST") {
  require_once "config.php";
    if (!empty($_POST['id_warung'])) {
    $sql = "DELETE FROM tbl_donasi WHERE id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
      mysqli_stmt_bind_param($stmt, "i", $param_id);
      $param_id = $_POST['id_warung'];
      if(mysqli_stmt_execute($stmt)){
        header("location: list-donasi.php?message=Success%20Delete%20Donasi");
      } else {
        header("location:list-donasi.php?message=Gagal%20Delete%20Data%20Donasi:$stmt->error");
      }
    }
  }
  mysqli_close($link);
}
?>