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
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li><a href="<?= base_url('#sosial') ?>">Sosial</a></li>
          <li>Bantuan Sosial BLT</li>
        </ol>
        <h2>Bantuan Sosial BLT</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container contact">
        <div class="row">
          <div class="col-6 mb-4">
            <h4><i class="bx bx-file me-2"></i>Data Bantuan Sosial BLT</h4>
          </div>
          <div class="col-6 mb-4 d-inline-flex justify-content-end align-items-center">
            <a class="btn btn-sm btn-outline-primary rounded-pill" href="<?= base_url('bantuan_sosial_pengajuan.php') ?>"><i data-feather="plus-circle" class="me-1 mb-1"></i>Pengajuan Baru</a>
            <button class="btn btn-sm btn-outline-primary rounded-pill ms-3 toggle_modal_cari_by_nik"><i data-feather="search" class="me-1 mb-1"></i>Cari Berdasarkan NIK</button>
          </div>
          <table class="table table-striped table-hover table-responsive datatables" id="tabel_bantuan_sosial" cellspacing="0" width="100%" style="font-size: 0.875rem">
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
              $query_bantuan_sosial = mysqli_query($connection, 
                "SELECT
                  a.id AS id_bantuan_sosial, a.tipe_bantuan, a.status_pengajuan, a.keterangan_pengajuan, a.created_at AS tgl_pengajuan,
                  b.id AS id_penduduk, b.nik, b.nama_lengkap, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi AS status_validasi_penduduk, b.keterangan_validasi AS keterangan_validasi_penduduk,
                  c.id AS id_kartu_keluarga, c.nomor_kk, c.nik_kepala_keluarga
                FROM tbl_bantuan_sosial AS a
                LEFT JOIN tbl_penduduk AS b
                  ON b.id = a.id_penduduk
                LEFT JOIN tbl_kartu_keluarga AS c
                  ON c.id = b.id_kartu_keluarga
                WHERE a.tipe_bantuan = 'BLT'
                ORDER BY a.id DESC");

              while ($bantuan_sosial = mysqli_fetch_assoc($query_bantuan_sosial)) :
                $status_bantuan_sosial = $bantuan_sosial['status_pengajuan'];
                $formatted_status_bantuan_sosial = ucwords(str_replace('_', ' ', $status_bantuan_sosial));
              ?>

                <tr>
                  <td scope="row"><?= $no++ ?></td>
                  <td><?= $bantuan_sosial['nama_lengkap'] ?></td>
                  <td>
                    <?php if ($status_bantuan_sosial === 'belum_diproses') : ?>

                      <span class="text-danger"><?= $formatted_status_bantuan_sosial ?></span>

                    <?php elseif ($status_bantuan_sosial === 'sudah_diproses') : ?>

                      <span class="text-success"><?= $formatted_status_bantuan_sosial ?></span>

                    <?php endif ?>
                  </td>
                  <td>
                    <?php if (!$bantuan_sosial['keterangan_pengajuan']): ?>

                      <small class="text-muted">Tidak ada</small>
                    
                    <?php else: ?>

                      <button type="button" class="btn btn-sm rounded-pill btn-outline-primary toggle_modal_detail"
                        data-keterangan_pengajuan="<?= htmlspecialchars($bantuan_sosial['keterangan_pengajuan']) ?>">
                        <i class="bi bi-list-ul me-1"></i>
                        Lihat keterangan
                      </button>

                    <?php endif ?>
                  </td>
                  <td><?= $bantuan_sosial['tgl_pengajuan'] ?></td>
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
                <th>Tipe Bantuan</th>
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

  <?php include 'index_script.php' ?>
  <?php include_once 'helpers/sweetalert2_notify.php' ?>

  <!-- PAGE SCRIPT -->
  <script>
    $(document).ready(function() {
      // Datatables initialise
      $('#tabel_bantuan_sosial').DataTable({
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

      
      $('#tabel_bantuan_sosial').on('click', '.toggle_modal_detail', function() {
        const keterangan_pengajuan = $(this).data('keterangan_pengajuan');
      
        $('#ModalDetailKeteranganPengajuan .modal-title').html(`<i data-feather="info" class="me-2"></i>Keterangan Pengajuan`);
        $('#ModalDetailKeteranganPengajuan #detail_keterangan_pengajuan').html(keterangan_pengajuan);
        
        // Re-init all feather icons
        feather.replace();
      
        $('#ModalDetailKeteranganPengajuan').modal('show');
      });
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
        $('#ModalCariByNik .modal-title').html(`<i data-feather="info" class="me-2 mb-1"></i>Cari Pengajuan Bantuan Sosial BLT`);
        
        // Re-init all feather icons
        feather.replace();

        $('#ModalCariByNik').modal('show');
      });


      $('#xnik_filter_btn').on('click', function() {
        const nik_filter = $('#xnik_filter').val();
        const tipe_bantuan = 'BLT';

        if (!nik_filter) {
          tableCariByNik.clear().draw();
          return;
        }

        $.ajax({
          url: 'get_bantuan_sosial_by_nik_and_tipe_bantuan.php',
          method: 'POST',
          data: {
            nik: nik_filter,
            tipe_bantuan: tipe_bantuan
          },
          dataType: 'JSON',
          success: function(datas) {
            if (datas === undefined || !datas.length) {
              tableCariByNik.clear().draw();
              return;
            }
            
            tableCariByNik.clear();

            let no = 1;

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

              let tableData = [no++, data.nik, data.nama_lengkap, data.tipe_bantuan, data.warga_negara, data.pekerjaan, statusPengajuan, tglPengajuan];
              
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