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
    <title>Laporan Proyek <?= "({$dari_tanggal} s.d. {$sampai_tanggal})" ?></title>
  </head>

  <body class="bg-white">
    <?php
    $no = 1;

    $stmt_proyek = mysqli_stmt_init($connection);
    $query_proyek ="SELECT * FROM tbl_proyek WHERE created_at BETWEEN ? AND ? ORDER BY id DESC";
      
    mysqli_stmt_prepare($stmt_proyek, $query_proyek);
    mysqli_stmt_bind_param($stmt_proyek, 'ss', $dari_tanggal, $sampai_tanggal);
    mysqli_stmt_execute($stmt_proyek);

    $result = mysqli_stmt_get_result($stmt_proyek);
    $proyeks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt_proyek);
    mysqli_close($connection);
    ?>

    <h4 class="text-center mb-4">Laporan Proyek <?= "({$dari_tanggal} s.d. {$sampai_tanggal})" ?></h4>

    <table class="table table-striped table-bordered table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Proyek</th>
          <th>Tujuan</th>
          <th>Manfaat</th>
          <th>Tahapan</th>
          <th>Status</th>
          <th>Tgl. Proyek</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!$result->num_rows): ?>

          <tr>
            <td colspan="8"><div class="text-center">Tidak ada data</div></td>
          </tr>
        
        <?php else: ?>

          <?php foreach($proyeks as $proyek) : ?>
            
            <?php
            $status_proyek = $proyek['status_proyek'];
            $formatted_status_proyek = ucwords(str_replace('_', ' ', $status_proyek));
            ?>

            <tr>
              <td><?= $no++ ?></td>
              <td><?= $proyek['nama_proyek'] ?></td>
              <td><?= $proyek['tujuan'] ?></td>
              <td><?= $proyek['manfaat'] ?></td>
              <td><?= $proyek['tahapan'] ?></td>
              <td>
                <?php if ($status_proyek === 'akan_dikerjakan'): ?>
                  
                  <span class="badge bg-red-soft text-red"><?= $formatted_status_proyek ?></span>
                  
                <?php elseif ($status_proyek === 'sedang_dikerjakan'): ?>
                
                  <span class="badge bg-purple-soft text-purple"><?= $formatted_status_proyek ?></span>
                  
                <?php elseif ($status_proyek === 'selesai'): ?>
                
                  <span class="badge bg-green-soft text-green"><?= $formatted_status_proyek ?></span>

                <?php endif ?>
              </td>
              <td class="text-nowrap"><?= $proyek['tgl_proyek'] ?></td>
            </tr>

          <?php endforeach ?>

        <?php endif ?>
      </tbody>
    </table>

  </body>

  </html>

<?php endif ?>