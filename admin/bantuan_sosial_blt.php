<?php
include '../helpers/isAccessAllowedHelper.php';

// cek apakah user yang mengakses adalah admin?
if (!isAccessAllowed('admin')) :
  session_destroy();
  echo "<meta http-equiv='refresh' content='0;" . base_url_return('index.php?msg=other_error') . "'>";
else :
  include_once '../config/connection.php';
?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php include '_partials/head.php' ?>

    <meta name="description" content="Data Bantuan Sosial BLT" />
    <meta name="author" content="" />
    <title>Bantuan Sosial BLT - <?= SITE_NAME ?></title>
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
                <h1 class="mb-0">Bantuan Sosial BLT</h1>
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
            
            <!-- Main page content-->
            <div class="card card-header-actions mb-4 mt-5">
              <div class="card-header">
                <div>
                  <i data-feather="file-text" class="me-2 mt-1"></i>
                  Data Bantuan Sosial BLT
                </div>
                <button class="btn btn-sm btn-primary toggle_modal_tambah" type="button"><i data-feather="plus-circle" class="me-2"></i>Tambah Data</button>
              </div>
              <div class="card-body">
                <table class="table table-hover table-bordered datatables" cellspacing="0" width="100%" style="font-size: 0.875rem">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th class="text-start">NIK</th>
                      <th>Nama</th>
                      <th>Tipe Bantuan</th>
                      <th>Status Pengajuan</th>
                      <th>Keterangan Pengajuan</th>
                      <th>Tanggal Pengajuan</th>
                      <th>Aksi</th>
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
    
    <!--============================= MODAL INPUT SURAT KERAMAIAN =============================-->
    <div class="modal fade" id="ModalInputPengajuanBantuanSosialBLT" tabindex="-1" role="dialog" aria-labelledby="ModalInputPengajuanBantuanSosialBLTTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalInputPengajuanBantuanSosialBLTTitle">Modal title</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <div class="modal-body">
              
              <input type="hidden" id="xid_bantuan_sosial" name="xid_bantuan_sosial">
              
              <div class="mb-3">
                <label class="small mb-1" for="xid_penduduk">Penduduk <span class="text-danger">*</span></label>
                <select name="xid_penduduk" class="form-control mb-1 select2" id="xid_penduduk">
                  <option value="">-- Pilih --</option>
                  <?php $query_penduduk = mysqli_query($connection, "SELECT id, nik, nama_lengkap FROM tbl_penduduk ORDER BY nama_lengkap ASC") ?>
                  <?php while ($penduduk = mysqli_fetch_assoc($query_penduduk)): ?>
  
                    <option value="<?= $penduduk['id'] ?>"><?= "{$penduduk['nik']} -- {$penduduk['nama_lengkap']}" ?></option>
  
                  <?php endwhile ?>
                  <?php mysqli_close($connection) ?>
                </select>
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xtipe_bantuan">Tipe Bantuan</label>
                <select name="xtipe_bantuan" class="form-control select2 xtipe_bantuan" id="xtipe_bantuan" required>
                  <option value="BLT">BLT</option>
                </select>
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xstatus_pengajuan">Status Pengajuan <span class="text-danger">*</span></label>
                <select name="xstatus_pengajuan" class="form-control mb-1 select2" id="xstatus_pengajuan">
                  <option value="belum_diproses">Belum Diproses</option>
                  <option value="sudah_diproses">Sudah Diproses</option>
                </select>
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xketerangan_pengajuan">Keterangan Pengajuan</label>
                <textarea class="form-control" id="xketerangan_pengajuan" name="xketerangan_pengajuan" rows="5" placeholder="Keterangan atau alasan dari status pengajuan" autocomplete="off"></textarea>
              </div>
                
            </div>
            <div class="modal-footer">
              <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button>
              <button class="btn btn-primary" id="toggle_swal_submit" type="submit">Simpan</button>
            </div>
          </form>
        </div>
      </di>
    </div>
    <!--/.modal-input-surat-keramaian -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {
        
        // Re-init all feather icons
        feather.replace();

        const modalInputSuratDomisiliSelect = $('#ModalInputPengajuanBantuanSosialBLT .select2');

        initSelect2(modalInputSuratDomisiliSelect, {
          width: '100%',
          dropdownParent: '#ModalInputPengajuanBantuanSosialBLT .modal-content .modal-body'
        });
        

        $('.toggle_modal_tambah').on('click', function() {
          $('#ModalInputPengajuanBantuanSosialBLT .modal-title').html(`<i data-feather="plus-circle" class="me-2 mt-1"></i>Tambah Bantuan Sosial BLT`);
          $('#ModalInputPengajuanBantuanSosialBLT form').attr({action: 'bantuan_sosial_blt_tambah.php', method: 'post'});

          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputPengajuanBantuanSosialBLT').modal('show');
        });


        $('.datatables').on('click', '.toggle_modal_ubah', function() {
          const data = $(this).data();
          
          $('#ModalInputPengajuanBantuanSosialBLT .modal-title').html(`<i data-feather="edit" class="me-2 mt-1"></i>Ubah Bantuan Sosial BLT`);
          $('#ModalInputPengajuanBantuanSosialBLT form').attr({action: 'bantuan_sosial_blt_ubah.php', method: 'post'});

          $('#ModalInputPengajuanBantuanSosialBLT #xid_bantuan_sosial').val(data.id_bantuan_sosial);
          $('#ModalInputPengajuanBantuanSosialBLT #xid_penduduk').val(data.id_penduduk).trigger('change');
          $('#ModalInputPengajuanBantuanSosialBLT #xstatus_pengajuan').val(data.status_pengajuan).trigger('change');
          $('#ModalInputPengajuanBantuanSosialBLT #xketerangan_pengajuan').val(data.keterangan_pengajuan);
          
          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputPengajuanBantuanSosialBLT').modal('show');
        });

        
        $('.datatables').on('click', '.toggle_modal_detail', function() {
          const keterangan_pengajuan = $(this).data('keterangan_pengajuan');
        
          $('#ModalDetailKeteranganPengajuan .modal-title').html(`<i data-feather="info" class="me-2"></i>Keterangan Pengajuan`);
          $('#ModalDetailKeteranganPengajuan #detail_keterangan_pengajuan').html(keterangan_pengajuan);
          
          // Re-init all feather icons
          feather.replace();
        
          $('#ModalDetailKeteranganPengajuan').modal('show');
        });
        

        $('.datatables').on('click', '.toggle_swal_hapus', function() {
          const id_bantuan_sosial = $(this).data('id_bantuan_sosial');
          const nama_lengkap = $(this).data('nama_lengkap');
          
          Swal.fire({
            title: "Konfirmasi Tindakan?",
            html: `Hapus data surat domisili: <strong>${nama_lengkap}?</strong>`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, konfirmasi!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Tindakan Dikonfirmasi!",
                text: "Halaman akan di-reload untuk memproses.",
                icon: "success",
                timer: 3000
              }).then(() => {
                window.location = `bantuan_sosial_blt_hapus.php?xid_bantuan_sosial=${id_bantuan_sosial}`;
              });
            }
          });
        });
        

        const formSubmitBtn = $('#toggle_swal_submit');
        const eventName = 'click';
        toggleSwalSubmit(formSubmitBtn, eventName);
        
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
        ajax: {
          url: `<?= base_url_return('admin/get_all_bantuan_sosial.php') ?>`,
          method: 'POST',
          data: { tipe_bantuan: 'BLT' }
        },
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
            data: 'nik',
            className: 'text-start'
          },
          { data: 'nama_lengkap' },
          { data: 'tipe_bantuan' },
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
          {
            data: null,
            render: function ( data, type, row ) {
              return `<button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_modal_ubah"
                  data-id_bantuan_sosial="${data.id_bantuan_sosial}"
                  data-id_penduduk="${data.id_penduduk}"
                  data-status_pengajuan="${data.status_pengajuan}"
                  data-keterangan_pengajuan="${data.keterangan_pengajuan}">
                  <i class="fa fa-pen-to-square"></i>
                </button>
                <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_swal_hapus"
                  data-id_bantuan_sosial="${data.id_bantuan_sosial}"
                  data-nama_lengkap="${data.nama_lengkap}">
                  <i class="fa fa-trash-can"></i>
                </button>`
            }
          }
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