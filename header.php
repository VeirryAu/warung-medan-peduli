<?php
  function getHeader() {
    $str = <<<EOD
      <header>
        <div class="container">
          <div class="navbar navbar-default">
            <a class="navbar-brand" href="index.php">
              <img src="./public/logo-new.png" alt="logo" class="" width="100" height="100" />
            </a>
            <div>
              <a href="register.php" class="btn btn-green">DAFTARKAN USER</a>
              <a href="donasi.php" class="btn btn-danger">DAFTARKAN RELAWAN</a>
            </div>
          </div>
        </div>
        <div class="bg-danger text-white nav nav-custom navbar navbar-expand-lg navbar-light custom-navbar">
          <div class="container">
            <nav class="navbar-light">
              <button class="navbar-toggler-custom navbar-toggler ml-auto hidden-sm-up float-xs-right collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
              </button>
              <div class="centeral collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item p-2 bg-danger-item">
                    <a href="index.php">HOME</a>
                  </li>
                  <li class="nav-item p-2 bg-danger-item">
                    <a href="relawan.php">DAFTARKAN RELAWAN</a>
                  </li>
                  <li class="nav-item p-2 bg-danger-item">
                    <a href="warung.php">DAFTARKAN USER</a>
                  </li>
                  <li class="nav-item p-2 bg-danger-item">
                    <a href="list-warung.php">LIST WARUNG</a>
                  </li>
                  <li class="nav-item p-2 bg-danger-item">
                    <a href="list-relawan.php">LIST RELAWAN</a>
                  </li>
                  <li class="nav-item p-2 bg-danger-item">
                    <a href="list-donasi.php">LIST DONASI</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </header>
      EOD;
    echo $str;
  }
  //   function getHeader() {

//     $str = <<<EOD
//   <div class="dropdown">
//     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//       Menu
//     </button>
//     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
//         <a href="register.php" class="dropdown-item">Daftarkan User</a>
//         <a href="relawan.php" class="dropdown-item">Daftarkan Relawan</a>
//         <a href="warung.php" class="dropdown-item">Daftarkan Warung</a>
//         <a href="list-relawan.php" class="dropdown-item">List Relawan</a>
//         <a href="list-warung.php" class="dropdown-item">List Warung</a>
//         <a href="list-donasi.php" class="dropdown-item">List Donasi</a>
//     </div>
//   </div>
// EOD;

//             echo $str;
//   }
?>