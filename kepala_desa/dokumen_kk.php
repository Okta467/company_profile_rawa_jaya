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

    <meta name="description" content="Data Dokumen KK" />
    <meta name="author" content="" />
    <title>Dokumen KK - <?= SITE_NAME ?></title>
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
                <h1 class="mb-0">Dokumen KK</h1>
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
                  <i data-feather="users" class="me-2 mt-1"></i>
                  Data Dokumen KK
                </div>
              </div>
              <div class="card-body">
                <table class="table table-hover table-bordered datatables" cellspacing="0" width="100%" style="font-size: 0.875rem">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th class="text-start">KK</th>
                      <th>Kepala Keluarga</th>
                      <th>Status Pengajuan</th>
                      <th>Keterangan Pengajuan</th>
                      <th>Tanggal Pengajuan</th>
                    </tr>
                  </thead>
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
    
    <!--============================= MODAL DETAIL =============================-->
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
    <!--/.modal-detail -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {
        
        // Re-init all feather icons
        feather.replace();

        
        $('#xcetak_laporan').on('click', function() {
          const dari_tanggal = $('#xdari_tanggal').val();
          const sampai_tanggal = $('#xsampai_tanggal').val();
          
          const url = `laporan_dokumen_kk.php?dari_tanggal=${dari_tanggal}&sampai_tanggal=${sampai_tanggal}`;
          
          printExternal(url);
        });

        
        $('.datatables').on('click', '.toggle_modal_detail', function() {
          const keterangan_pengajuan = $(this).data('keterangan_pengajuan');
        
          $('#ModalDetailKeteranganPengajuan .modal-title').html(`<i data-feather="info" class="me-2"></i>Keterangan Pengajuan`);
          $('#ModalDetailKeteranganPengajuan #detail_keterangan_pengajuan').html(keterangan_pengajuan);
          
          // Re-init all feather icons
          feather.replace();
        
          $('#ModalDetailKeteranganPengajuan').modal('show');
        });
        
      });
    </script>


    <!-- Datatables with child row initialization for `.datatables` -->
    <script>
      // Formatting function for row details - modify as you need
      function format(d) {
        const status_validasi = d.status_validasi === 'sudah_divalidasi'
          ? `<span class="badge bg-green-soft text-green">Sudah Divalidasi</span>`
          : `<span class="badge bg-red-soft text-red">Belum Divalidasi</span>`;

        // `d` is the original data object for the row
        return (
          '<dl>' +
          '<dt>Status Validasi Penduduk:</dt>' +
          '<dd>' +
          status_validasi +
          '<dt>Keterangan Validasi Penduduk:</dt>' +
          '<dd>' +
          d.keterangan_validasi +
          '<dt>Tempat, Tanggal Lahir:</dt>' +
          '<dd>' +
          d.tmp_lahir + ', ' + d.tgl_lahir +
          '</dd>' +
          '<dt>Warga Negara:</dt>' +
          '<dd>' +
          d.warga_negara +
          '</dd>' +
          '<dt>Pekerjaan:</dt>' +
          '<dd>' +
          d.pekerjaan +
          '</dd>' +
          '<dt>Email:</dt>' +
          '<dd>' +
          d.email +
          '</dd>' +
          '<dt>Alamat:</dt>' +
          '<dd>' +
          d.alamat +
          '</dd>' +
          '</dl>'
        );
      }
        
      let table = new DataTable('.datatables', {  
        ajax: `<?= base_url_return('kepala_desa/get_all_dokumen_kk.php') ?>`,
        order: [],
        scrollX: true,
        columns: [
          {
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: ''
          },
          { 
            data: null,
            render: function(data, type, row, meta) {
              return meta.row + 1; // Return the row number starting from 1
            }
          }, // Incremental number
          {
            data: 'nomor_kk',
            className: 'text-start'
          },
          {
            data: null,
            render: function ( data, type, row ) {
              const nik = data.nik
                ? `<small class='text-muted'>(${data.nik})</small>`
                : "<small class='text-muted'>(Tidak ada NIK)</small>";
              
              return `${data.nama_lengkap}<br>${nik}`;
            }
          },
          {
            data: null,
            render: function( data, type, row ) {
              return data.status_pengajuan === 'sudah_diproses'
                ? `<span class="badge bg-green-soft text-green">Sudah Diproses</span>`
                : `<span class="badge bg-red-soft text-red">Belum Diproses</span>`;
            }
          },
          {
            data: null,
            render: function( data, type, row ) {
              const isset_keterangan_pengajuan = data.keterangan_pengajuan === undefined || !data.keterangan_pengajuan.length;

              return isset_keterangan_pengajuan
                ? '<small class="text-muted">Tidak ada</small>'
                : `<button type="button" class="btn btn-xs rounded-pill btn-outline-primary toggle_modal_detail"
                    data-keterangan_pengajuan="${data.keterangan_pengajuan}">
                    <i data-feather="list" class="me-1"></i>
                    Lihat keterangan
                  </button>`;
            }
          },
          { data: 'tgl_pengajuan' },
        ],
      });
        
      // Add event listener for opening and closing details
      table.on('click', 'td.dt-control', function (e) {
        let tr = e.target.closest('tr');
        let row = table.row(tr);
      
        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
        }
        else {
          // Open this row
          row.child(format(row.data())).show();
        }
      });
      
      // Re-init all feather icons
      feather.replace();
    </script>

  </body>

  </html>

<?php endif ?>