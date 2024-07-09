<!DOCTYPE html>
<html lang="en">

<head>
  <?php session_start() ?>
  <?php include 'config/config.php' ?>
  <?php include 'config/connection.php' ?>
  <?php include 'index_head.php' ?>
  <?php include 'helpers/isAccessAllowedHelper.php' ?>
  <?php include 'helpers/isAlreadyLoginHelper.php' ?>

  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <meta name="Description" content="Halaman Login">
  <title><?= SITE_NAME_SHORT_ALTERNATIVE ?></title>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include 'index_header_2.php' ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li><a href="index.php#administrasi">Administrasi</a></li>
          <li>Surat Keramaian</li>
        </ol>
        <h2>Surat Keramaian</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container contact">
        <div class="row">
          <div class="col-6 mb-4">
            <h4><i class="bx bx-file me-2"></i>Data Surat Keramaian</h4>
          </div>
          <div class="col-6 mb-4 d-inline-flex justify-content-end align-items-center">
            <button class="btn btn-sm btn-outline-primary rounded-pill toggle_modal_tambah"><i data-feather="plus-circle" class="me-1 mb-1"></i>Pengajuan Baru</button>
          </div>
          <small class="mb-4 text-muted">Jika NIK tidak ditemukan saat pengajuan, silakan isi data Anda <a class="btn-link" href="dokumen_ktp.php">di sini</a>.</small>
          <table class="table table-striped table-hover table-responsive datatables" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Perihal</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Tgl. Pengajuan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query_surat_keramaian = mysqli_query($connection, 
                "SELECT
                  a.id AS id_surat_keramaian, a.perihal, a.status_pengajuan AS status_pengajuan_surat_keramaian, a.keterangan_pengajuan AS keterangan_pengajuan_surat_keramaian, a.created_at AS tgl_pengajuan_surat_keramaian,
                  b.id AS id_penduduk, b.nik, b.nama_lengkap, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi AS status_validasi_penduduk, b.keterangan_validasi AS keterangan_validasi_penduduk,
                  c.id AS id_kartu_keluarga, c.nomor_kk, c.nik_kepala_keluarga
                FROM tbl_surat_keramaian AS a
                LEFT JOIN tbl_penduduk AS b
                  ON b.id = a.id_penduduk
                LEFT JOIN tbl_kartu_keluarga AS c
                  ON c.id = b.id_kartu_keluarga
                ORDER BY a.id DESC");

              while ($surat_keramaian = mysqli_fetch_assoc($query_surat_keramaian)) :
                $status_surat_keramaian = $surat_keramaian['status_pengajuan_surat_keramaian'];
                $formatted_status_surat_keramaian = ucwords(str_replace('_', ' ', $status_surat_keramaian));
              ?>

                <tr>
                  <td scope="row"><?= $no++ ?></td>
                  <td><?= $surat_keramaian['nama_lengkap'] ?></td>
                  <td>
                    <div class="ellipsis toggle_tooltip" title="<?= $surat_keramaian['perihal'] ?>">
                      <?= $surat_keramaian['perihal'] ?>
                    </div>
                  </td>
                  <td>
                    <?php if ($status_surat_keramaian === 'belum_diproses') : ?>

                      <small class="text-danger"><?= $formatted_status_surat_keramaian ?></small>

                    <?php elseif ($status_surat_keramaian === 'sudah_diproses') : ?>

                      <small class="text-success"><?= $formatted_status_surat_keramaian ?></small>

                    <?php endif ?>
                  </td>
                  <td>
                    <?php if (!$surat_keramaian['keterangan_pengajuan_surat_keramaian']): ?>

                      <small class="text-muted">Tidak ada</small>
                    
                    <?php else: ?>

                      <button type="button" class="btn btn-sm rounded-pill btn-outline-primary toggle_modal_detail"
                        data-detail="<?= htmlspecialchars($surat_keramaian['keterangan_pengajuan_surat_keramaian']) ?>">
                        <i class="bi bi-list-ul me-1"></i>
                        Lihat keterangan
                      </button>

                    <?php endif ?>
                  </td>
                  <td><?= date('d-m-Y', strtotime($surat_keramaian['tgl_pengajuan_surat_keramaian'])) ?></td>
                </tr>

              <?php endwhile ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'index_footer.php' ?>
  <!-- End Footer -->

  <div id="preloader"></div> <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!--============================= MODAL CARI PENGAJUAN =============================-->
  <div class="modal fade" id="ModalCariPengajuan" tabindex="-1" role="dialog" aria-labelledby="ModalCariPengajuan" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="px-3 py-1" id="detail_surat_keramaian"></div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!--/.modal-cari-pengajuan -->
    
  <!--============================= MODAL INPUT SURAT KERAMAIAN =============================-->
  <div class="modal fade" id="ModalInputSuratKeramaian" tabindex="-1" role="dialog" aria-labelledby="ModalInputSuratKeramaianTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalInputSuratKeramaianTitle">Modal title</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
          <div class="modal-body">
            
            <input type="hidden" id="xid_jabatan" name="xid_jabatan">
          
            <div class="mb-3">
              <label class="small mb-1" for="xnik">NIK</label>
              <input type="text" name="xnik" minlength="16" maxlength="16" class="form-control mb-1" id="xnik" placeholder="Enter nik" required />
              <small class="text-danger d-none" id="xnik_help">NIK tidak ditemukan, harap buat data penduduk baru <a class="btn-link" href="dokumen_ktp.php">di sini</a></small>
            </div>
          
            <div class="mb-3">
              <label class="small mb-1" for="xperihal">Perihal</label>
              <input type="text" name="xperihal" class="form-control" id="xperihal" placeholder="Enter perihal" required />
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" id="toggle_swal_submit" type="submit" name="xsubmit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--/.modal-input-surat-keramaian -->

  <?php include 'index_script.php' ?>
  <?php include_once 'helpers/sweetalert2_notify.php' ?>

  <!-- PAGE SCRIPT -->
  <script>
    $(document).ready(function() {
      // Datatables initialise
      $('.datatables').DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [
          [3, 5, 10, 25, 50, 100],
          [3, 5, 10, 25, 50, 100],
        ]
      });

      // Remove tfoot if it exists
      $('.datatables tfoot').remove();

      $('.toggle_tooltip').tooltip({
        placement: 'top',
        delay: {
          show: 500,
          hide: 100
        }
      });


      const selectNik = $('#xid_penduduk')

      initSelect2(selectNik, {
        width: '100%',
        dropdownParent: "#ModalInputSuratKeramaian .modal-content .modal-body"
      });
      
      // Re-init all feather icons
      feather.replace();


      $('.toggle_modal_tambah').on('click', function() {
        $('#ModalInputSuratKeramaian .modal-title').html(`<i data-feather="plus-circle" class="me-2 mb-1"></i>Pengajuan Surat Keramaian`);
        $('#ModalInputSuratKeramaian form').attr({action: 'surat_keramaian_tambah.php', method: 'post'});

        // Re-init all feather icons
        feather.replace();
        
        $('#ModalInputSuratKeramaian').modal('show');
      });


      let debounceTimer;

      $('#xnik').on('keyup', function() {
        const nik = $(this).val();

        clearTimeout(debounceTimer); // Clear the previous timeout
        debounceTimer = setTimeout(function() {
          $.ajax({
            url: 'get_penduduK_by_nik.php',
            method: 'POST',
            data: {
              nik: nik
            },
            dataType: 'JSON',
            success: function(data) {
              !data.length
                ? $('#xnik_help').removeClass('d-none')
                : $('#xnik_help').addClass('d-none');
            },
            error: function(request, status, error) {
              console.log("ajax call went wrong:" + request.responseText);
              // console.log("ajax call went wrong:" + error);
            }
          })
        }, 500);
      });
        
      
      const formSubmitBtn = $('#toggle_swal_submit');
      const eventName = 'click';
      const formElement = $('#ModalInputSuratKeramaian form');
      const submitElement = $('<input />')
        .attr('type', 'hidden')
        .attr('name', 'xsubmit')
        .attr('value', 'Buat Akun');

      toggleSwalSubmit(formSubmitBtn, eventName, formElement, submitElement);
    });
  </script>

</body>

</html>