<?php
include '../helpers/isAccessAllowedHelper.php';

// cek apakah user yang mengakses adalah admin?
if (!isAccessAllowed('admin')) :
  session_destroy();
  echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
else :
  include_once '../config/connection.php';

  $id_proyek = $_GET['id_proyek'] ?? null;

  if ($id_proyek) {
    $stmt_proyek = mysqli_stmt_init($connection);
    $query_proyek = "SELECT * FROM tbl_proyek WHERE id=?";

    mysqli_stmt_prepare($stmt_proyek, $query_proyek);
    mysqli_stmt_bind_param($stmt_proyek, 'i', $id_proyek);
    mysqli_stmt_execute($stmt_proyek);

    $result = mysqli_stmt_get_result($stmt_proyek);
    $proyek = mysqli_fetch_assoc($result);
  }

  $form_action = $id_proyek ? 'proyek_ubah.php' : 'proyek_tambah.php';

  $nama_proyek   = $proyek['nama_proyek'] ?? null;
  $tujuan        = $proyek['tujuan'] ?? null;
  $manfaat       = $proyek['manfaat'] ?? null;
  $tahapan       = $proyek['tahapan'] ?? null;
  $detail        = $proyek['detail'] ?? null;
  $tgl_proyek    = $proyek['tgl_proyek'] ?? null;
  $status_proyek = $proyek['status_proyek'] ?? null;
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
          <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
              <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                  <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                      <div class="page-header-icon"><i data-feather="file-plus"></i></div>
                      Proyek Kerja Baru
                    </h1>
                  </div>
                  <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="proyek.php?go=proyek">
                      <i class="me-1" data-feather="arrow-left"></i>
                      Kembali ke Proyek
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </header>
          <!-- Main page content-->
          <div class="container-fluid px-4">
            <form action="<?= $form_action ?>" method="POST">
              <div class="row gx-4">
              
                <div class="col-lg-8">

                  <!-- Data Proyek -->
                  <div class="card mb-4">
                    <div class="card-header">Data Proyek</div>
                    <div class="card-body">

                      <input type="hidden" name="xid_proyek" value="<?= $id_proyek ?>">
                      
                      <div class="mb-3">
                        <label class="small mb-1" for="xnama_proyek">Nama Proyek <span class="text-danger">*</span></label>
                        <input type="text" name="xnama_proyek" value="<?= $nama_proyek ?>" class="form-control" id="xnama_proyek" placeholder="Enter nama proyek" required>
                      </div>
                      
                      <div class="mb-3">
                        <label class="small mb-1" for="xtujuan">Tujuan <span class="text-danger">*</span></label>
                        <input type="text" name="xtujuan" value="<?= $tujuan ?>" class="form-control" id="xtujuan" placeholder="Enter tujuan" required>
                        <small class="text-danger">Maksimal 1000 karakter!</small>
                      </div>
                      
                      <div class="mb-3">
                        <label class="small mb-1" for="xmanfaat">Manfaat <span class="text-danger">*</span></label>
                        <input type="text" name="xmanfaat" value="<?= $manfaat ?>" class="form-control" id="xmanfaat" placeholder="Enter manfaat" required>
                        <small class="text-danger">Maksimal 1000 karakter!</small>
                      </div>
                      
                  
                      <div class="row gx-3 mb-3">
                  
                        <div class="mb-3 col-md-6">
                          <label class="small mb-1" for="xstatus_proyek">Status <span class="text-danger">*</span></label>
                          <select name="xstatus_proyek" class="form-control select2" id="xstatus_proyek" required>
                            <option value="">-- Pilih --</option>
                            <option value="akan_dikerjakan" <?= $status_proyek === 'akan_dikerjakan' ? 'selected' : '' ?>>Akan Dikerjakan</option>
                            <option value="sedang_dikerjakan" <?= $status_proyek === 'sedang_dikerjakan' ? 'selected' : '' ?>>Sedang Dikerjakan</option>
                            <option value="selesai" <?= $status_proyek === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                          </select>
                        </div>
                  
                        <div class="mb-3 col-md-6">
                          <label class="small mb-1" for="xtgl_proyek">Tanggal Proyek <span class="text-danger">*</span></label>
                          <input type="date" name="xtgl_proyek" value="<?= $tgl_proyek ?>" class="form-control" id="xtgl_proyek" placeholder="Enter tanggal proyek" required>
                        </div>
                  
                      </div>
                  
                    </div>
                  </div>
                  
                  <!-- Tahapan Proyek -->
                  <div class="card card-header-actions mb-4 mb-lg-0">
                    <div class="card-header">
                      Tahapan Proyek
                      <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="Teks di dalam input hanya sebagai contoh saja."></i>
                    </div>
                    <div class="card-body">
                      <p class="small text-danger">Teks maksimal 1000 karakter!</p>
                      <textarea name="xtahapan" id="tahapanProyekEditor"></textarea>
                    </div>
                  </div>
                  
                  <!-- Detail Proyek -->
                  <div class="card card-header-actions mb-4 mb-lg-0">
                    <div class="card-header">
                      Detail Proyek
                      <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="Teks di dalam input hanya sebagai contoh saja."></i>
                    </div>
                    <div class="card-body">
                      <p class="small text-danger">Teks maksimal 5000 karakter!</p>
                      <textarea name="xdetail" id="detailProyekEditor"></textarea>
                    </div>
                  </div>

                </div>


                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-header">
                      Publish
                    </div>
                    <div class="card-body text-center p-5">
                      <div class="d-grid">
                        <button class="fw-500 btn btn-primary" id="toggle_swal_submit" type="submit">Simpan Proyek</button>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>
            </form>
          </div>
        </main>
        
        <!--============================= FOOTER =============================-->
        <?php include '_partials/footer.php' ?>
        <!--//END FOOTER -->

      </div>
    </div>
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {
        var easyMDETahapanProyek = new EasyMDE({
          element: document.getElementById('tahapanProyekEditor'),
          toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', 'preview', 'guide'],
        });

        var easyMDEDetailProyek = new EasyMDE({
          element: document.getElementById('detailProyekEditor'),
          toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', 'preview', 'guide'],
        });


        const select2 = $('.select2');

        initSelect2(select2, {
          width: '100%',
          dropdownParent: 'body'
        });
        

        const formSubmitBtn = $('#toggle_swal_submit');
        const eventName = 'click';
        const formElement = formSubmitBtn.parents('div.container-fluid').find('form');

        toggleSwalSubmit(formSubmitBtn, eventName, formElement);

        
        const tahapan = `<?= "{$tahapan}" ?>`;
        const sanitizedTahapan = DOMPurify.sanitize(tahapan, { USE_PROFILES: { html: true } });
        
        easyMDETahapanProyek.value(sanitizedTahapan)


        const detail = `<?= "{$detail}" ?>`;
        const sanitizedDetail = DOMPurify.sanitize(detail, { USE_PROFILES: { html: true } });
        
        easyMDEDetailProyek.value(sanitizedDetail)
      });
    </script>

  </body>

  </html>

<?php endif ?>