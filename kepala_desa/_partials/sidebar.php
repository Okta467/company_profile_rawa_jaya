<?php
$current_page = $_GET['go'] ?? '';
$user_logged_in = $_SESSION['nama_pegawai'] ?? $_SESSION['nama_guest'] ?? $_SESSION['username'];
?>

<nav class="sidenav shadow-right sidenav-light">
  <div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">
      <!-- Sidenav Menu Heading (Core)-->
      <div class="sidenav-menu-heading">Core</div>
      
      <a class="nav-link <?php if ($current_page === 'dashboard') echo 'active' ?>" href="index.php?go=dashboard">
        <div class="nav-link-icon"><i data-feather="activity"></i></div>
        Dashboard
      </a>

      <div class="sidenav-menu-heading">Pengguna</div>
      
      <a class="nav-link <?php if ($current_page === 'profil') echo 'active' ?>" href="profil.php?go=profil">
        <div class="nav-link-icon"><i data-feather="user"></i></div>
        Profil
      </a>
      
      <div class="sidenav-menu-heading">Administrasi</div>
      
      <a class="nav-link <?php if ($current_page === 'surat_domisili') echo 'active' ?>" href="surat_domisili.php?go=surat_domisili">
        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
        Surat Domisili
      </a>
      
      <a class="nav-link <?php if ($current_page === 'surat_keramaian') echo 'active' ?>" href="surat_keramaian.php?go=surat_keramaian">
        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
        Surat Keramaian
      </a>
      
      <a class="nav-link <?php if ($current_page === 'dokumen_ktp') echo 'active' ?>" href="dokumen_ktp.php?go=dokumen_ktp">
        <div class="nav-link-icon"><i class="far fa-address-card"></i></div>
        Dokumen KTP
      </a>
      
      <a class="nav-link <?php if ($current_page === 'dokumen_kk') echo 'active' ?>" href="dokumen_kk.php?go=dokumen_kk">
        <div class="nav-link-icon"><i data-feather="users"></i></div>
        Dokumen KK
      </a>
      
      <div class="sidenav-menu-heading">Sosial</div>
      
      <a class="nav-link <?php if ($current_page === 'bantuan_sosial_pkh') echo 'active' ?>" href="bantuan_sosial_pkh.php?go=bantuan_sosial_pkh">
        <div class="nav-link-icon"><i class="bx bx-wallet" style="font-size: 1rem"></i></div>
        PKH
      </a>
      
      <a class="nav-link <?php if ($current_page === 'bantuan_sosial_blt') echo 'active' ?>" href="bantuan_sosial_blt.php?go=bantuan_sosial_blt">
        <div class="nav-link-icon"><i class="bx bx-wallet" style="font-size: 1rem"></i></div>
        BLT
      </a>
      
      <a class="nav-link <?php if ($current_page === 'bantuan_sosial_pendidikan') echo 'active' ?>" href="bantuan_sosial_pendidikan.php?go=bantuan_sosial_pendidikan">
        <div class="nav-link-icon"><i class="bx bx-book-reader" style="font-size: 1rem"></i></div>
        Pendidikan
      </a>
      
      <div class="sidenav-menu-heading">Infrastruktur</div>
      
      <a class="nav-link <?php if ($current_page === 'proyek') echo 'active' ?>" href="proyek.php?go=proyek">
        <div class="nav-link-icon"><i class="far fa-building" style="font-size: 1rem"></i></div>
        Proyek
      </a>
      
      <div class="sidenav-menu-heading">Lainnya</div>
      
      <a class="nav-link" href="<?= base_url('logout.php') ?>">
        <div class="nav-link-icon"><i data-feather="log-out"></i></div>
        Keluar
      </a>

    </div>
  </div>
  <!-- Sidenav Footer-->
  <div class="sidenav-footer">
    <div class="sidenav-footer-content">
      <div class="sidenav-footer-subtitle">Anda masuk sebagai:</div>
      <div class="sidenav-footer-title"><?= ucwords($user_logged_in) ?></div>
    </div>
  </div>
</nav>