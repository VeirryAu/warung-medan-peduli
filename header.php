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
              <a href="logout.php" class="topnav-right">Log Out</a>
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
                  <a href="index.php">
                    <li class="nav-item p-2 bg-danger-item">
                      HOME
                    </li>
                  </a>
                  <a href="relawan.php">
                    <li class="nav-item p-2 bg-danger-item">
                    TAMBAH RELAWAN
                    </li>
                  </a>
                  <a href="warung.php">
                    <li class="nav-item p-2 bg-danger-item">
                    TAMBAH WARUNG
                    </li>
                  </a>
                  <a href="register.php">
                    <li class="nav-item p-2 bg-danger-item">
                    TAMBAH USER
                    </li>
                  </a>
                  <a href="donasi.php">
                    <li class="nav-item p-2 bg-danger-item">
                    TAMBAH DONASI
                    </li>
                  </a>
                  <a href="list-warung.php">
                    <li class="nav-item p-2 bg-danger-item">
                      LIST WARUNG
                    </li>
                  </a>
                  <a href="list-relawan.php">
                    <li class="nav-item p-2 bg-danger-item">
                      LIST RELAWAN
                    </li>
                  </a>
                  <a href="list-donasi.php">
                    <li class="nav-item p-2 bg-danger-item">
                      LIST DONASI
                    </li>
                  </a>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </header>
EOD;
    echo $str;
  }
?>