<?php
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  $list = array();

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    require_once "config.php";

    if (!empty($_GET['id'])) {
      $sql = "SELECT id, nama_warung, nama_pemilik, phone_no, kecamatan, tanggal_kunjungan, qty_pesanan, jumlah_uang, nama_menu, alamat, gambar_warung, photo_pemilik FROM tbl_warung WHERE id = ? ORDER BY id DESC LIMIT 1";
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $_GET['id'];
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $id, $nama_warung, $nama_pemilik, $phone_no, $kecamatan, $tanggal_kunjungan, $qty_pesanan, $jumlah_uang, $nama_menu, $alamat, $gambar_warung, $photo_pemilik);
            if(mysqli_stmt_fetch($stmt)){

            }
          }
        } else {
        }
      }
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
  <title>List Warung - Warung Medan Peduli | Untuk Relawan dan Pengurus | warungmedanpeduli.com</title>
  <?php include "css.php" ?>
  <?php include "js.php" ?>
</head>
<style>
a, a:hover, a:focus, a:active {
  text-decoration: none;
  color: inherit;
}
</style>
<body class="body white">
  <?php include 'header.php';getHeader(); ?>
  <div class="container grid-container mt-4">
      <?php if (!empty($_GET['message'])) echo "<small id='emailHelp' class='form-text text-primary topnav-center'>" . $_GET['message'] . "</small>"; ?>
    <div class="grid-container-layout">
    <div class="card" style="width: 100%;">
        <div class="row">
          <div class="col-4">
            <img class="image-warung" style="padding-left:5px;object-fit: contain;" width="120" height="120" src="/<?php echo $gambar_warung; ?>" alt="<?php echo $value['nama_warung']; ?>">
          </div>
          <div class="col-8">
            <div class="">
              <h5 class="card-title" style="padding:4px 0px;margin:0px;margin-top:10px"><?php echo $nama_warung; ?></h5>
              <p class="card-text" style="font-weight:thin;padding:4px 0px;margin:4px 0px;">
              <?php echo $nama_pemilik; ?><br />
              <?php echo $alamat; ?>
              </p>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  <div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="delete-warung.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Warung</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <input type="hidden" value="" name="id_warung" id="id_warung" />
        </div>
        <div class="modal-body">
          <p>Apakah kamu yakin untuk delete warung ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
<script>
  function onDelete (id) {
    $('#id_warung').val(id)
  }
</script>
</html>
