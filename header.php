<?php
  function getHeader() {

    $str = <<<EOD
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Menu
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a href="register.php" class="dropdown-item">Daftarkan User</a>
        <a href="relawan.php" class="dropdown-item">Daftarkan Relawan</a>
        <a href="warung.php" class="dropdown-item">Daftarkan Warung</a>
        <a href="list-relawan.php" class="dropdown-item">List Relawan</a>
        <a href="list-warung.php" class="dropdown-item">List Warung</a>
        <a href="list-donasi.php" class="dropdown-item">List Donasi</a>
    </div>
  </div>
EOD;

            echo $str;
  }
?>