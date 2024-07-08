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
      
      <a class="nav-link <?php if ($current_page === 'pengguna') echo 'active' ?>" href="pengguna.php?go=pengguna">
        <div class="nav-link-icon"><i data-feather="users"></i></div>
        Pengguna
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
      
      <a class="nav-link <?php if ($current_page === 'pengajuan_bantuan_sosial') echo 'active' ?>" href="pengajuan_bantuan_sosial.php?go=pengajuan_bantuan_sosial">
        <div class="nav-link-icon"><i data-feather="file-text"></i></div>
        Pengajuan
      </a>
      
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
      
      <div class="sidenav-menu-heading">Saran dan Masukan</div>
      
      <a class="nav-link <?php if ($current_page === 'saran_dan_masukan') echo 'active' ?>" href="saran_dan_masukan.php?go=saran_dan_masukan">
        <div class="nav-link-icon"><i data-feather="inbox"></i></div>
        Saran dan Masukan
      </a>
      
      <div class="sidenav-menu-heading">Kepala Desa</div>
      
      <a class="nav-link <?php if ($current_page === 'kepala_desa') echo 'active' ?>" href="kepala_desa.php?go=kepala_desa">
        <div class="nav-link-icon"><i data-feather="user"></i></div>
        Kepala Desa
      </a>
      
      <?php
      if (in_array($current_page, ['jabatan', 'pangkat_golongan', 'pendidikan', 'jurusan_pendidikan'])) {
        $active_nav_container_detail_kepala_desa = 'active';
        $show_nav_menu_detail_kepala_desa = 'show';
      }
      ?>
      
      <a class="nav-link collapsed <?= $active_nav_container_detail_kepala_desa ?? '' ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDetailKepalaDesa" aria-expanded="false" aria-controls="collapseDetailKepalaDesa">
        <div class="nav-link-icon"><i data-feather="book"></i></div>
        Detail
        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
      </a>
      <div class="collapse <?= $show_nav_menu_detail_kepala_desa ?? '' ?>" id="collapseDetailKepalaDesa" data-bs-parent="#accordionSidenav">
        <nav class="sidenav-menu-nested nav">
          <a class="nav-link <?php if ($current_page === 'jabatan') echo 'active' ?>" href="jabatan.php?go=jabatan">
            Jabatan
          </a>
          <a class="nav-link <?php if ($current_page === 'pangkat_golongan') echo 'active' ?>" href="pangkat_golongan.php?go=pangkat_golongan">
            Pangkat / Golongan
          </a>
          <a class="nav-link <?php if ($current_page === 'pendidikan') echo 'active' ?>" href="pendidikan.php?go=pendidikan">
            Pendidikan
          </a>
          <a class="nav-link <?php if ($current_page === 'jurusan_pendidikan') echo 'active' ?>" href="jurusan_pendidikan.php?go=jurusan_pendidikan">
            Jurusan
          </a>
        </nav>
      </div>
      
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