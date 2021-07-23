<?php
  function getHeader($type) {

    switch ($type) {
      case 'home':
        $home = "active";
        break;
      case 'about':
        $about = "active";
        break;
      case 'portofolio':
        $portofolio = "active";
        break;
      case 'contact':
        $contact = "active";
        break;
      default:
        # code...
        break;
    }

    $str = <<<EOD
  <div class="nav nav-custom navbar navbar-expand-lg navbar-light custom-navbar ">
    <a href="index.php" class="nav-logo" style="padding-top:20px;">
      <img class="logo" width="auto" height="45px" src="/public/logo/logo-black-1.png">
    </a>
    <button class="navbar-toggler-custom navbar-toggler ml-auto hidden-sm-up float-xs-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="centeral collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item nav-item-header">
          <a href="index.php" class="logo-header" style="margin-right: 4rem">
            <img class="logo" width="250px" height="auto" src="/public/logo/logo-black-1.png">
          </a>
        </li>
        <li class="nav-item nav-margin-top $home">
          <a href="index.php" class="nav-link">BERANDA</a>
        </li>
        <li class="nav-item nav-margin-top $about">
          <a href="about.php" class="nav-link">TENTANG KAMI</a>
        </li>
        <li class="nav-item nav-margin-top $portofolio">
          <a href="portofolio.php" class="nav-link">PORTOFOLIO</a>
        </li>
        <li class="nav-item nav-margin-top $contact">
          <a href="contact-us.php" class="nav-link">HUBUNGI KAMI</a>
        </li>
        <li class="nav-item nav-margin-top">
          <a target="_blank" href="https://api.whatsapp.com/send?phone=6282267761122&text=Hello%20admin%20MP,%20Saya%20ingin%20buat%20baju%20nih%20sebanyak%20:%20" class="link-footer"><button type="button" class="btn btn-light bold custom-button-header" style="color: #ffffff">CHAT KAMI</button></a>
        </li>
      </ul>
    </div>
</div>
EOD;

            echo $str;
  }
?>