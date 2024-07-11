<?php
include '../helpers/isAccessAllowedHelper.php';

// cek apakah user yang mengakses adalah kepala_desa?
if (!isAccessAllowed('kepala_desa')) :
  session_destroy();
  echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
else :
  include_once '../config/connection.php';
?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php include '_partials/head.php' ?>

    <meta name="description" content="Data Proyek" />
    <meta name="author" content="" />
    <title>Proyek - <?= SITE_NAME ?></title>
  </head>

  <body class="nav-fixed">
    <!--============================= TOPNAV =============================-->
    <?php include '_partials/topnav.php' ?>
    <!--//END TOPNAV -->
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <!--============================= SIDEBAR =============================-->
        <?php include '_partials/sidebar.php' ?>
        <!--//END SIDEBAR -->
      </div>
      <div id="layoutSidenav_content">
        <main>
          <!-- Main page content-->
          <div class="container-xl px-4 mt-5">

            <!-- Custom page header alternative example-->
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
              <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Proyek</h1>
                <div class="small">
                  <span class="fw-500 text-primary"><?= date('D') ?></span>
                  &middot; <?= date('M d, Y') ?> &middot; <?= date('H:i') ?> WIB
                </div>
              </div>

              <!-- Date range picker example-->
              <div class="input-group input-group-joined border-0 shadow w-auto">
                <span class="input-group-text"><i data-feather="calendar"></i></span>
                <input class="form-control ps-0 pointer" id="litepickerRangePlugin" value="Tanggal: <?= date('d M Y') ?>" readonly />
              </div>

            </div>
            
            <!-- Tools Cetak Pengumuman -->
            <div class="card mb-4 mt-5">
              <div class="card-header">
                <div>
                  <i data-feather="settings" class="me-2 mt-1"></i>
                  Tools Cetak Laporan
                </div>
              </div>
              <div class="card-body">
                <div class="row gx-3">
                  <div class="col-md-2 mb-3">
                    <label class="small mb-1" for="xdari_tanggal">Dari Tanggal</label>
                    <input class="form-control" id="xdari_tanggal" type="date" name="xdari_tanggal" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label class="small mb-1" for="xsampai_tanggal">Sampai Tanggal</label>
                    <input class="form-control" id="xsampai_tanggal" type="date" name="xsampai_tanggal" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label class="small mb-1 invisible" for="xcetak_laporan">Filter Button</label>
                    <button class="btn btn-primary w-100" id="xcetak_laporan" type="button">
                      <i data-feather="printer" class="me-1"></i>
                      Cetak
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Main page content-->
            <div class="card card-header-actions mb-4 mt-5">
              <div class="card-header">
                <div>
                  <i class="far fa-building me-2"></i>
                  Data Proyek
                </div>
                <a class="btn btn-sm btn-primary" href="proyek_halaman_tambah_or_ubah.php?go=proyek"><i data-feather="plus-circle" class="me-2"></i>Tambah Data</a>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Proyek</th>
                      <th>Tujuan</th>
                      <th>Manfaat</th>
                      <th>Tahapan</th>
                      <th>Detail</th>
                      <th>Status</th>
                      <th>Tgl. Proyek</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query_proyek = mysqli_query($connection, "SELECT * FROM tbl_proyek ORDER BY id DESC");

                    while ($proyek = mysqli_fetch_assoc($query_proyek)):
                      $status_proyek = $proyek['status_proyek'];
                      $formatted_status_proyek = ucwords(str_replace('_', ' ', $status_proyek));
                      
                      $link_ubah_proyek = "proyek_halaman_tambah_or_ubah.php?go=proyek";
                      $link_ubah_proyek .= "&id_proyek={$proyek['id']}";
                    ?>

                      <tr>
                        <td><?= $no++ ?></td>
                        <td>
                          <div class="ellipsis toggle_tooltip" title="<?= $proyek['nama_proyek'] ?>">
                            <?= $proyek['nama_proyek'] ?>
                          </div>
                        </td>
                        <td>
                          <div class="ellipsis toggle_tooltip" title="<?= $proyek['tujuan'] ?>">
                            <?= $proyek['tujuan'] ?>
                          </div>
                        </td>
                        <td>
                          <div class="ellipsis toggle_tooltip" title="<?= $proyek['manfaat'] ?>">
                            <?= $proyek['manfaat'] ?>
                          </div>
                        </td>
                        <td>
                          <button type="button" class="btn btn-xs rounded-pill btn-outline-primary text-nowrap toggle_modal_detail"
                            data-tahapan="<?= htmlspecialchars($proyek['tahapan']) ?>">
                            <i data-feather="list" class="me-1"></i>
                            Lihat Tahapan
                          </button>
                        </td>
                        <td>
                          <button type="button" class="btn btn-xs rounded-pill btn-outline-primary text-nowrap toggle_modal_detail"
                            data-detail="<?= htmlspecialchars($proyek['detail']) ?>">
                            <i data-feather="list" class="me-1"></i>
                            Lihat Detail
                          </button>
                        </td>
                        <td>
                          <?php if ($status_proyek === 'akan_dikerjakan'): ?>
                            
                            <span class="badge bg-red-soft text-red"><?= $formatted_status_proyek ?></span>
                            
                          <?php elseif ($status_proyek === 'sedang_dikerjakan'): ?>
                          
                            <span class="badge bg-purple-soft text-purple"><?= $formatted_status_proyek ?></span>
                            
                          <?php elseif ($status_proyek === 'selesai'): ?>
                          
                            <span class="badge bg-green-soft text-green"><?= $formatted_status_proyek ?></span>

                          <?php endif ?>
                        </td>
                        <td><?= $proyek['tgl_proyek'] ?></td>
                      </tr>

                    <?php endwhile ?>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>
        </main>
        
        <!--============================= FOOTER =============================-->
        <?php include '_partials/footer.php' ?>
        <!--//END FOOTER -->

      </div>
    </div>
    
    <!--============================= MODAL PESAN DETAIL =============================-->
    <!-- * * Note: * * This modal also can be used for tahapan-->
    <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="ModalDetail" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <div class="p-3" id="detail_proyek"></div>
            
          </div>
          <div class="modal-footer">
            <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    <!--/.modal-pesan-detail -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {

        $('#xcetak_laporan').on('click', function() {
          const dari_tanggal = $('#xdari_tanggal').val();
          const sampai_tanggal = $('#xsampai_tanggal').val();
          
          const url = `laporan_proyek.php?dari_tanggal=${dari_tanggal}&sampai_tanggal=${sampai_tanggal}`;
          
          printExternal(url);
        });
        
        
        $('.toggle_modal_detail').on('click', function() {
          const tahapan = $(this).data('tahapan');
          const detail = $(this).data('detail');
          const modal_title = tahapan ? 'Tahapan Proyek' : 'Detail Proyek';

          const html_text = tahapan ?? detail;

          const sanitized_html_text = DOMPurify.sanitize(html_text, { USE_PROFILES: { html: true } });
          const parsed_html_text = marked.parse(sanitized_html_text);
    
          $('#ModalDetail #detail_proyek').html(parsed_html_text);

          $('#ModalDetail .modal-title').html(`<i data-feather="info" class="me-2 mt-1"></i>${modal_title}`);
          
          // Re-init all feather icons
          feather.replace();

          $('#ModalDetail').modal('show');
        });
        
      });
    </script>

  </body>

  </html>

<?php endif ?>