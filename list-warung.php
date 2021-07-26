<?php
  session_start();

  $list = array();

  if ($_SERVER["REQUEST_METHOD"] =="GET"){
    require_once "config.php";

    $sql = "SELECT id, nama_warung, nama_pemilik, phone_no, kecamatan, tanggal_kunjungan, qty_pesanan, jumlah_uang, nama_menu, alamat, gambar_warung, photo_pemilik FROM tbl_warung ORDER BY id DESC LIMIT 100";

    if($stmt = mysqli_query($link, $sql)){
      while ($row = mysqli_fetch_assoc($stmt)) {
        $list[] = $row;
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
      <?php
      if(count($list) > 0) {
        foreach ($list as $key => $value) {
      ?>
      <div class="card" style="width: 100%;">
        <div class="row">
          <div class="col-4">
            <img class="image-warung" style="padding-left:5px;object-fit: contain;" width="120" height="120" src="/<?php echo $value['gambar_warung']; ?>" alt="<?php echo $value['nama_warung']; ?>">
          </div>
          <div class="col-8">
            <div class="">
                <div class="topnav-right">
                  <?php if ($_SESSION["roleAs"] == "superadmin") { ?>
                  <div>
                    <button id="deleteButton" onclick="onDelete(<?php echo $value['id'] ?>)" data-toggle="modal" data-target="#exampleModal" style="padding:4px 10px;margin:0 10px;color:white;" class="btn btn-danger ">Hapus</button>
                  </div>
                  <?php } ?>
                  <div>
                    <a href="detail-warung.php?id=<?php echo $value['id'] ?>"><button id="detailButton" style="padding:4px 10px;margin:0 10px;margin-top:10px;color:#212121;" class="btn btn-default">Detail</button></a>
                  </div>
                </div>
              <h5 class="card-title" style="padding:4px 0px;margin:0px;margin-top:10px"><?php echo $value['nama_warung']; ?></h5>
              <p class="card-text" style="padding:4px 0px;margin:4px 0px;"><?php echo $value['alamat']; ?></p>
              <p class=""><?php echo $value['tanggal_kunjungan']; ?></p>
            </div>
          </div>
        </div>
        
      </div>
      <?php
        }
      } else {
      ?>
        <a href="warung.php"><small id='emailHelp' class='form-text text-primary topnav-center'>Daftar kan warung</small></a>
      <?php
      }
      ?>
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
