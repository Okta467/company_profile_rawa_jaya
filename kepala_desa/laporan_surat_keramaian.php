<?php
include '../helpers/isAccessAllowedHelper.php';

// cek apakah user yang mengakses adalah kepala_desa?
if (!isAccessAllowed('kepala_desa')) :
  session_destroy();
  echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
else :
  include_once '../config/connection.php';

  $dari_tanggal = $_GET['dari_tanggal'] ?? null;
  $sampai_tanggal = $_GET['sampai_tanggal'] ?? null;

  if (!$dari_tanggal || !$sampai_tanggal) {
    echo 'Input dari dan sampai tanggal harus diisi!';
    return;
  }
?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php include '_partials/head.php' ?>

    <meta name="description" content="Data Pengumuman" />
    <meta name="author" content="" />
    <title>Laporan Surat Keramaian <?= "({$dari_tanggal} s.d. {$sampai_tanggal})" ?></title>
  </head>

  <body class="bg-white">
    <?php
    $no = 1;

    $stmt_surat_keramaian = mysqli_stmt_init($connection);
    $query_surat_keramaian = 
      "SELECT
          a.id AS id_surat_keramaian, a.perihal, a.status_pengajuan AS status_pengajuan, a.keterangan_pengajuan AS keterangan_pengajuan, a.created_at AS tgl_pengajuan,
          b.id AS id_penduduk, b.nik, b.nama_lengkap, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi AS status_validasi, b.keterangan_validasi AS keterangan_validasi,
          c.id AS id_kartu_keluarga, c.nomor_kk, c.nik_kepala_keluarga
        FROM tbl_surat_keramaian AS a
        LEFT JOIN tbl_penduduk AS b
          ON b.id = a.id_penduduk
        LEFT JOIN tbl_kartu_keluarga AS c
          ON c.id = b.id_kartu_keluarga
        WHERE a.created_at BETWEEN ? AND ?
        ORDER BY a.id DESC";
      
    mysqli_stmt_prepare($stmt_surat_keramaian, $query_surat_keramaian);
    mysqli_stmt_bind_param($stmt_surat_keramaian, 'ss', $dari_tanggal, $sampai_tanggal);
    mysqli_stmt_execute($stmt_surat_keramaian);

    $result = mysqli_stmt_get_result($stmt_surat_keramaian);
    $surat_keramaians = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt_surat_keramaian);
    mysqli_close($connection);
    ?>

    <h4 class="text-center mb-4">Laporan Surat Keramaian <?= "({$dari_tanggal} s.d. {$sampai_tanggal})" ?></h4>

    <table class="table table-striped table-bordered table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th class="text-start">NIK</th>
          <th>Nama</th>
          <th>Perihal</th>
          <th>Warga Negara</th>
          <th>Status Pengajuan</th>
          <th>Keterangan Pengajuan</th>
          <th>Tanggal Pengajuan</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!$result->num_rows): ?>

          <tr>
            <td colspan="8"><div class="text-center">Tidak ada data</div></td>
          </tr>
        
        <?php else: ?>

          <?php foreach($surat_keramaians as $surat_keramaian) : ?>

            <tr>
              <td><?= $no++ ?></td>
              <td><?= $surat_keramaian['nik'] ?></td>
              <td><?= $surat_keramaian['nama_lengkap'] ?></td>
              <td><?= $surat_keramaian['perihal'] ?></td>
              <td><?= $surat_keramaian['warga_negara'] ?></td>
              <td>
                <?=
                $surat_keramaian['status_pengajuan'] === 'sudah_diproses'
                  ? '<span class="badge bg-green-soft text-green">Sudah Diproses</span>'
                  : '<span class="badge bg-red-soft text-red">Belum Diproses</span>';
                ?>
              </td>
              <td><?= $surat_keramaian['keterangan_pengajuan'] ?></td>
              <td><?= $surat_keramaian['tgl_pengajuan'] ?></td>
            </tr>

          <?php endforeach ?>

        <?php endif ?>
      </tbody>
    </table>

  </body>

  </html>

<?php endif ?>