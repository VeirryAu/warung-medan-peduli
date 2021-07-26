<?php
  if($_SERVER["REQUEST_METHOD"] =="POST") {
  require_once "config.php";
    if (!empty($_POST['id_warung'])) {
    $sql = "DELETE FROM tbl_warung WHERE id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
      mysqli_stmt_bind_param($stmt, "i", $param_id);
      $param_id = $_POST['id_warung'];
      if(mysqli_stmt_execute($stmt)){
        header("location: list-warung.php?message=Success%20Delete%20Warung");
        exit;
      } else {
        header("location:list-warung.php?message=Gagal%20Delete%20Data%20Warung:$stmt->error");
        exit;
      }
    }
  }
  mysqli_close($link);
}
?>