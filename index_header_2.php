<?php $current_page = $_GET['go'] ?? ''; ?>

<header id="header" class="fixed-top header-inner-pages">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="<?= base_url() ?>"><?= SITE_NAME_SHORT ?></a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="<?= base_url() ?>">Beranda</a></li>
        <li><a class="nav-link scrollto <?php if ($current_page === 'administrasi') echo 'active' ?>" href="<?= base_url('#administrasi') ?>">Administrasi</a></li>
        <li><a class="nav-link scrollto <?php if ($current_page === 'sosial') echo 'active' ?>" href="<?= base_url('#sosial') ?>">Sosial</a></li>
        <li><a class="nav-link scrollto" href="<?= base_url('#infrastruktur') ?>">Infrastruktur</a></li>
        <li><a class="nav-link scrollto" href="<?= base_url('#kontak') ?>">Kontak</a></li>
        <li><a class="btn btn-outline-info rounded-pill border-2 py-1 px-3 mx-3 ms-lg-4 me-lg-0 mt-3 mt-lg-0 text-white" href="login.php">Masuk</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header>