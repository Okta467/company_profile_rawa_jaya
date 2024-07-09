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
          <li>Surat Domisili</li>
        </ol>
        <h2>Surat Domisili</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container contact">
        <div class="row">
          <div class="col-6 mb-4">
            <h4><i class="bx bx-file me-2"></i>Data Surat Domisili</h4>
          </div>
          <div class="col-6 mb-4 d-inline-flex justify-content-end align-items-center">
            <button class="btn btn-sm btn-outline-primary rounded-pill toggle_modal_tambah"><i data-feather="plus-circle" class="me-1 mb-1"></i>Pengajuan Baru</button>
            <button class="btn btn-sm btn-outline-primary rounded-pill ms-3 toggle_modal_cari_by_nik"><i data-feather="search" class="me-1 mb-1"></i>Cari Berdasarkan NIK</button>
            </div>
          <small class="mb-4 text-muted">Jika NIK tidak ditemukan saat pengajuan, silakan isi data Anda sebagai Penduduk Baru <a class="btn-link" href="dokumen_ktp.php">di sini</a>.</small>
          <table class="table table-striped table-hover table-responsive datatables" id="tabel_surat_domisili" cellspacing="0" width="100%" style="font-size: 0.875rem">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Tgl. Pengajuan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query_surat_domisili = mysqli_query($connection, 
                "SELECT
                  a.id AS id_surat_domisili, a.status_pengajuan AS status_pengajuan, a.keterangan_pengajuan AS keterangan_pengajuan, a.created_at AS tgl_pengajuan,
                  b.id AS id_penduduk, b.nik, b.nama_lengkap, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi AS status_validasi_penduduk, b.keterangan_validasi AS keterangan_validasi_penduduk,
                  c.id AS id_kartu_keluarga, c.nomor_kk, c.nik_kepala_keluarga
                FROM tbl_surat_domisili AS a
                LEFT JOIN tbl_penduduk AS b
                  ON b.id = a.id_penduduk
                LEFT JOIN tbl_kartu_keluarga AS c
                  ON c.id = b.id_kartu_keluarga
                ORDER BY a.id DESC");

              while ($surat_domisili = mysqli_fetch_assoc($query_surat_domisili)) :
                $status_surat_domisili = $surat_domisili['status_pengajuan'];
                $formatted_status_surat_domisili = ucwords(str_replace('_', ' ', $status_surat_domisili));
              ?>

                <tr>
                  <td scope="row"><?= $no++ ?></td>
                  <td><?= $surat_domisili['nama_lengkap'] ?></td>
                  <td>
                    <?php if ($status_surat_domisili === 'belum_diproses') : ?>

                      <span class="text-danger"><?= $formatted_status_surat_domisili ?></span>

                    <?php elseif ($status_surat_domisili === 'sudah_diproses') : ?>

                      <span class="text-success"><?= $formatted_status_surat_domisili ?></span>

                    <?php endif ?>
                  </td>
                  <td>
                    <?php if (!$surat_domisili['keterangan_pengajuan']): ?>

                      <small class="text-muted">Tidak ada</small>
                    
                    <?php else: ?>

                      <button type="button" class="btn btn-sm rounded-pill btn-outline-primary toggle_modal_detail"
                        data-keterangan_pengajuan="<?= htmlspecialchars($surat_domisili['keterangan_pengajuan']) ?>">
                        <i class="bi bi-list-ul me-1"></i>
                        Lihat keterangan
                      </button>

                    <?php endif ?>
                  </td>
                  <td><?= $surat_domisili['tgl_pengajuan'] ?></td>
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
  
  <!--============================= MODAL PESAN DETAIL =============================-->
  <div class="modal fade" id="ModalDetailKeteranganPengajuan" tabindex="-1" role="dialog" aria-labelledby="ModalDetailKeteranganPengajuan" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <div class="px-3 py-1" id="detail_keterangan_pengajuan"></div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!--/.modal-pesan-detail -->
  
  <!--============================= MODAL CARI BY NIK =============================-->
  <div class="modal fade" id="ModalCariByNik" tabindex="-1" role="dialog" aria-labelledby="ModalCariByNik" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  
          <div class="mb-4">
            <label for="xnik_filter">Cari berdasarkan NIK</label>
            <div class="input-group mb-3">
              <input type="text" name="xnik_filter" class="form-control" id="xnik_filter" placeholder="Enter NIK"><button class="input-group-text" id="xnik_filter_btn">Cari</button>
            </div>
          </div>
  
          <table class="table table-hover table-bordered datatables" id="table_cari_by_nik" cellspacing="0" width="100%" style="font-size: 0.875rem">
            <thead>
              <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Warga Negara</th>
                <th>Pekerjaan</th>
                <th>Status Pengajuan</th>
                <th>Tanggal Pengajuan</th>
              </tr>
            </thead>
          </table>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!--/.modal-cari-by-nik -->
    
  <!--============================= MODAL INPUT SURAT DOMISILI =============================-->
  <div class="modal fade" id="ModalInputSuratDomisili" tabindex="-1" role="dialog" aria-labelledby="ModalInputSuratDomisiliTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalInputSuratDomisiliTitle">Modal title</h5>
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

          </div>
          <div class="modal-footer">
            <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" id="toggle_swal_submit" type="submit" name="xsubmit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--/.modal-input-surat-domisili -->

  <?php include 'index_script.php' ?>
  <?php include_once 'helpers/sweetalert2_notify.php' ?>

  <!-- PAGE SCRIPT -->
  <script>
    $(document).ready(function() {
      // Datatables initialise
      $('#tabel_surat_domisili').DataTable({
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
        dropdownParent: "#ModalInputSuratDomisili .modal-content .modal-body"
      });
      
      // Re-init all feather icons
      feather.replace();


      $('.toggle_modal_tambah').on('click', function() {
        $('#ModalInputSuratDomisili .modal-title').html(`<i data-feather="plus-circle" class="me-2 mb-1"></i>Pengajuan Surat Domisili`);
        $('#ModalInputSuratDomisili form').attr({action: 'surat_domisili_tambah.php', method: 'post'});

        // Re-init all feather icons
        feather.replace();
        
        $('#ModalInputSuratDomisili').modal('show');
      });

      
      $('#tabel_surat_domisili').on('click', '.toggle_modal_detail', function() {
        const keterangan_pengajuan = $(this).data('keterangan_pengajuan');
      
        $('#ModalDetailKeteranganPengajuan .modal-title').html(`<i data-feather="info" class="me-2"></i>Keterangan Pengajuan`);
        $('#ModalDetailKeteranganPengajuan #detail_keterangan_pengajuan').html(keterangan_pengajuan);
        
        // Re-init all feather icons
        feather.replace();
      
        $('#ModalDetailKeteranganPengajuan').modal('show');
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
      const formElement = $('#ModalInputSuratDomisili form');
      const submitElement = $('<input />')
        .attr('type', 'hidden')
        .attr('name', 'xsubmit')
        .attr('value', 'Buat Akun');

      toggleSwalSubmit(formSubmitBtn, eventName, formElement, submitElement);
    });
  </script>


  <!-- Script for cari berdasarkan NIK (table and search input)  -->
  <script>
    $(document).ready(function() {

      let tableCariByNik = $('#table_cari_by_nik').DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [
          [3, 5, 10, 25, 50, 100],
          [3, 5, 10, 25, 50, 100],
        ]
      });

      $('.toggle_modal_cari_by_nik').on('click', function() {
        $('#ModalCariByNik .modal-title').html(`<i data-feather="info" class="me-2 mb-1"></i>Cari Pengajuan Surat Domisili`);
        
        // Re-init all feather icons
        feather.replace();

        $('#ModalCariByNik').modal('show');
      });


      $('#xnik_filter_btn').on('click', function() {
        const nik_filter = $('#xnik_filter').val();

        if (!nik_filter) {
          tableCariByNik.clear().draw();
          return;
        }

        $.ajax({
          url: 'get_surat_domisili_by_nik.php',
          method: 'POST',
          data: {
            nik: nik_filter
          },
          dataType: 'JSON',
          success: function(datas) {
            if (datas === undefined || !datas.length) {
              tableCariByNik.clear().draw();
              return;
            }
            
            tableCariByNik.clear();

            datas.forEach(function(data) {
              let statusPengajuan;

              if (!data.status_pengajuan) {
                statusPengajuan = '<small class="text-muted">Belum ada pengajuan</small>';
              } else {
                statusPengajuan = data.status_pengajuan === 'sudah_diproses'
                  ? `<span class="text-success">Sudah Diproses</span>`
                  : `<span class="text-danger">Belum Diproses</span>`;
              }

              let tglPengajuan = data.tgl_pengajuan ?? '<small class="text-muted">Belum ada pengajuan</small>';

              let tableData = [1, data.nik, data.nama_lengkap, data.warga_negara, data.pekerjaan, statusPengajuan, tglPengajuan];
              
              tableCariByNik.row.add(tableData);
            });

            tableCariByNik.draw();
            tableCariByNik.columns.adjust();
          },
          error: function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
            // console.log("ajax call went wrong:" + error);
          }
        })
      });
    
    });
  </script>

</body>

</html>