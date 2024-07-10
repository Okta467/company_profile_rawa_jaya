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
          <li>Dokumen KK</li>
        </ol>
        <h2>Dokumen KK</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container contact">
        <div class="row">
          <div class="col-6 mb-4">
            <h4><i class="bx bx-file me-2"></i>Data Dokumen KK</h4>
          </div>
          <div class="col-6 mb-4 d-inline-flex justify-content-end align-items-center">
            <button class="btn btn-sm btn-outline-primary rounded-pill toggle_modal_tambah"><i data-feather="plus-circle" class="me-1 mb-1"></i>Pengajuan Baru</button>
            <button class="btn btn-sm btn-outline-primary rounded-pill ms-3 toggle_modal_cari_by_kk"><i data-feather="search" class="me-1 mb-1"></i>Cari Berdasarkan KK</button>
            </div>
          <small class="mb-4 text-muted">Jika KK tidak ditemukan saat pengajuan, harap hubungi Admin <?= SITE_NAME ?> untuk mendata KK baru.</small>
          <table class="table table-striped table-hover table-responsive datatables" id="tabel_dokumen_kk" cellspacing="0" width="100%" style="font-size: 0.875rem">
            <thead>
              <tr>
                <th>#</th>
                <th>Kepala Keluarga</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Tgl. Pengajuan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query_dokumen_kk = mysqli_query($connection, 
                "SELECT
                  a.id AS id_dokumen_kk, a.status_pengajuan, a.keterangan_pengajuan, a.created_at AS tgl_pengajuan,
                  b.id AS id_kartu_keluarga, b.nomor_kk, b.nik_kepala_keluarga,
                  c.id AS id_penduduk, c.nik, c.nama_lengkap, c.jk, c.tmp_lahir, c.tgl_lahir, c.warga_negara, c.agama, c.pekerjaan, c.alamat, c.email, c.status_validasi AS status_validasi_penduduk, c.keterangan_validasi AS keterangan_validasi_penduduk
                FROM tbl_dokumen_kk AS a
                INNER JOIN tbl_kartu_keluarga AS b
                  ON b.id = a.id_kartu_keluarga
                LEFT JOIN tbl_penduduk AS c
                  ON c.nik = b.nik_kepala_keluarga
                ORDER BY a.id DESC");

              while ($dokumen_kk = mysqli_fetch_assoc($query_dokumen_kk)) :
                $status_dokumen_kk = $dokumen_kk['status_pengajuan'];
                $formatted_status_dokumen_kk = ucwords(str_replace('_', ' ', $status_dokumen_kk));
              ?>

                <tr>
                  <td scope="row"><?= $no++ ?></td>
                  <td><?= $dokumen_kk['nama_lengkap'] ?></td>
                  <td>
                    <div class="ellipsis toggle_tooltip" title="<?= $dokumen_kk['alamat'] ?>">
                      <?= $dokumen_kk['alamat'] ?>
                    </div>
                  </td>
                  <td>
                    <?php if ($status_dokumen_kk === 'belum_diproses') : ?>

                      <span class="text-danger"><?= $formatted_status_dokumen_kk ?></span>

                    <?php elseif ($status_dokumen_kk === 'sudah_diproses') : ?>

                      <span class="text-success"><?= $formatted_status_dokumen_kk ?></span>

                    <?php endif ?>
                  </td>
                  <td>
                    <?php if (!$dokumen_kk['keterangan_pengajuan']): ?>

                      <small class="text-muted">Tidak ada</small>
                    
                    <?php else: ?>

                      <button type="button" class="btn btn-sm rounded-pill btn-outline-primary toggle_modal_detail"
                        data-keterangan_pengajuan="<?= htmlspecialchars($dokumen_kk['keterangan_pengajuan']) ?>">
                        <i class="bi bi-list-ul me-1"></i>
                        Lihat keterangan
                      </button>

                    <?php endif ?>
                  </td>
                  <td><?= $dokumen_kk['tgl_pengajuan'] ?></td>
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
  
  <!--============================= MODAL CARI BY KK =============================-->
  <div class="modal fade" id="ModalCariByKK" tabindex="-1" role="dialog" aria-labelledby="ModalCariByKK" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  
          <div class="mb-4">
            <label for="xnomor_kk_filter">Cari berdasarkan KK</label>
            <div class="input-group mb-3">
              <input type="text" name="xnomor_kk_filter" class="form-control" id="xnomor_kk_filter" placeholder="Enter KK"><button class="input-group-text" id="xnomor_kk_filter_btn">Cari</button>
            </div>
          </div>

          <table class="table table-hover table-bordered datatables" id="table_cari_by_kk" cellspacing="0" width="100%" style="font-size: 0.875rem">
            <thead>
              <tr>
                <th>#</th>
                <th>KK</th>
                <th>Kepala Keluarga</th>
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
  <!--/.modal-cari-by-nomor_kk -->
    
  <!--============================= MODAL INPUT DOKUMEN KK =============================-->
  <div class="modal fade" id="ModalInputDokumenKK" tabindex="-1" role="dialog" aria-labelledby="ModalInputDokumenKKTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalInputSuratKartuKeluargaTitle">Modal title</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
          <div class="modal-body">
          
            <div class="mb-3">
              <label class="small mb-1" for="xnomor_kk">Nomor Kartu Keluarga (KK)</label>
              <input type="text" name="xnomor_kk" minlength="16" maxlength="16" class="form-control mb-1" id="xnomor_kk" placeholder="Enter nomor kartu keluarga" required />
              <small class="text-danger d-none" id="xnomor_kk_help">KK tidak ditemukan, harap hubungi Admin <?= SITE_NAME ?> untuk mendata KK baru.</small>
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
  <!--/.modal-input-dokumen-kk -->

  <?php include 'index_script.php' ?>
  <?php include_once 'helpers/sweetalert2_notify.php' ?>

  <!-- PAGE SCRIPT -->
  <script>
    $(document).ready(function() {
      // Datatables initialise
      $('#tabel_dokumen_kk').DataTable({
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
      
      // Re-init all feather icons
      feather.replace();


      $('.toggle_modal_tambah').on('click', function() {
        $('#ModalInputDokumenKK .modal-title').html(`<i data-feather="plus-circle" class="me-2 mb-1"></i>Pengajuan Dokumen KK`);
        $('#ModalInputDokumenKK form').attr({action: 'dokumen_kk_tambah.php', method: 'post'});

        // Re-init all feather icons
        feather.replace();
        
        $('#ModalInputDokumenKK').modal('show');
      });

      
      $('#tabel_dokumen_kk').on('click', '.toggle_modal_detail', function() {
        const keterangan_pengajuan = $(this).data('keterangan_pengajuan');
      
        $('#ModalDetailKeteranganPengajuan .modal-title').html(`<i data-feather="info" class="me-2"></i>Keterangan Pengajuan`);
        $('#ModalDetailKeteranganPengajuan #detail_keterangan_pengajuan').html(keterangan_pengajuan);
        
        // Re-init all feather icons
        feather.replace();
      
        $('#ModalDetailKeteranganPengajuan').modal('show');
      });


      let debounceTimer;

      $('#xnomor_kk').on('keyup', function() {
        const nomor_kk = $(this).val();

        clearTimeout(debounceTimer); // Clear the previous timeout
        debounceTimer = setTimeout(function() {
          $.ajax({
            url: 'get_kartu_keluarga_by_nomor_kk.php',
            method: 'POST',
            data: {
              nomor_kk: nomor_kk
            },
            dataType: 'JSON',
            success: function(data) {
              !data.length
                ? $('#xnomor_kk_help').removeClass('d-none')
                : $('#xnomor_kk_help').addClass('d-none');
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
      const formElement = $('#ModalInputDokumenKK form');
      const submitElement = $('<input />')
        .attr('type', 'hidden')
        .attr('name', 'xsubmit')
        .attr('value', 'Ajukan Dokumen KK');

      toggleSwalSubmit(formSubmitBtn, eventName, formElement, submitElement);
    });
  </script>


  <!-- Script for cari berdasarkan KK (table and search input)  -->
  <script>
    $(document).ready(function() {

      let tableCariByNik = $('#table_cari_by_kk').DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [
          [3, 5, 10, 25, 50, 100],
          [3, 5, 10, 25, 50, 100],
        ]
      });

      $('.toggle_modal_cari_by_kk').on('click', function() {
        $('#ModalCariByKK .modal-title').html(`<i data-feather="info" class="me-2 mb-1"></i>Cari Pengajuan Dokumen KK`);
        
        // Re-init all feather icons
        feather.replace();

        $('#ModalCariByKK').modal('show');
      });


      $('#xnomor_kk_filter_btn').on('click', function() {
        const nomor_kk_filter = $('#xnomor_kk_filter').val();

        if (!nomor_kk_filter) {
          tableCariByNik.clear().draw();
          return;
        }

        $.ajax({
          url: 'get_dokumen_kk_by_nomor_kk.php',
          method: 'POST',
          data: {
            nomor_kk: nomor_kk_filter
          },
          dataType: 'JSON',
          success: function(datas) {
            console.log(datas)
            if (datas === undefined || !datas.length) {
              tableCariByNik.clear().draw();
              return;
            }
            
            tableCariByNik.clear();
            
            let no = 1;

            datas.forEach(function(data) {
              let kepala_keluarga = `${data.nama_lengkap}<br><small class="text-muted">(${data.nik_kepala_keluarga})</small>`;
              
              let statusPengajuan;

              if (!data.status_pengajuan) {
                statusPengajuan = '<small class="text-muted">Belum ada pengajuan</small>';
              } else {
                statusPengajuan = data.status_pengajuan === 'sudah_diproses'
                  ? `<span class="text-success">Sudah Diproses</span>`
                  : `<span class="text-danger">Belum Diproses</span>`;
              }

              let tglPengajuan = data.tgl_pengajuan ?? '<small class="text-muted">Belum ada pengajuan</small>';
              
              let tableData = [no++, data.nomor_kk, kepala_keluarga, data.warga_negara, data.pekerjaan, statusPengajuan, tglPengajuan];
              
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