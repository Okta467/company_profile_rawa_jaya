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
    <title>Laporan Dokumen KK <?= "({$dari_tanggal} s.d. {$sampai_tanggal})" ?></title>
  </head>

  <body class="bg-white">
    <?php
    $no = 1;

    $stmt_dokumen_kk = mysqli_stmt_init($connection);
    $query_dokumen_kk = 
        "SELECT
          a.id AS id_dokumen_kk, a.status_pengajuan, a.keterangan_pengajuan, a.created_at AS tgl_pengajuan,
          b.id AS id_kartu_keluarga, b.nomor_kk, b.nik_kepala_keluarga,
          c.id AS id_penduduk, c.nik, c.nama_lengkap, c.jk, c.tmp_lahir, c.tgl_lahir, c.warga_negara, c.agama, c.pekerjaan, c.alamat, c.email, c.status_validasi AS status_validasi, c.keterangan_validasi AS keterangan_validasi
        FROM tbl_dokumen_kk AS a
        INNER JOIN tbl_kartu_keluarga AS b
          ON b.id = a.id_kartu_keluarga
        LEFT JOIN tbl_penduduk AS c
          ON c.nik = b.nik_kepala_keluarga
        WHERE a.created_at BETWEEN ? AND ?
        ORDER BY a.id DESC";
      
    mysqli_stmt_prepare($stmt_dokumen_kk, $query_dokumen_kk);
    mysqli_stmt_bind_param($stmt_dokumen_kk, 'ss', $dari_tanggal, $sampai_tanggal);
    mysqli_stmt_execute($stmt_dokumen_kk);

    $result = mysqli_stmt_get_result($stmt_dokumen_kk);
    $dokumen_kks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt_dokumen_kk);
    mysqli_close($connection);
    ?>

    <h4 class="text-center mb-4">Laporan Dokumen KK <?= "({$dari_tanggal} s.d. {$sampai_tanggal})" ?></h4>

    <table class="table table-striped table-bordered table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th class="text-start">NIK</th>
          <th>Nama</th>
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

          <?php foreach($dokumen_kks as $dokumen_kk) : ?>

            <tr>
              <td><?= $no++ ?></td>
              <td><?= $dokumen_kk['nik'] ?></td>
              <td><?= $dokumen_kk['nama_lengkap'] ?></td>
              <td><?= $dokumen_kk['warga_negara'] ?></td>
              <td>
                <?=
                $dokumen_kk['status_pengajuan'] === 'sudah_diproses'
                  ? '<span class="badge bg-green-soft text-green">Sudah Diproses</span>'
                  : '<span class="badge bg-red-soft text-red">Belum Diproses</span>';
                ?>
              </td>
              <td><?= $dokumen_kk['keterangan_pengajuan'] ?></td>
              <td><?= $dokumen_kk['tgl_pengajuan'] ?></td>
            </tr>

          <?php endforeach ?>

        <?php endif ?>
      </tbody>
    </table>

  </body>

  </html>

<?php endif ?>