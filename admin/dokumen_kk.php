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
            
            <!-- Main page content-->
            <div class="card card-header-actions mb-4 mt-5">
              <div class="card-header">
                <div>
                  <i data-feather="file-text" class="me-2 mt-1"></i>
                  Data Dokumen KK
                </div>
                <button class="btn btn-sm btn-primary toggle_modal_tambah" type="button"><i data-feather="plus-circle" class="me-2"></i>Tambah Data</button>
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
    
    <!--============================= MODAL INPUT DOKUMEN KK =============================-->
    <div class="modal fade" id="ModalInputDokumenKK" tabindex="-1" role="dialog" aria-labelledby="ModalInputDokumenKKTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalInputDokumen KKTitle">Modal title</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <div class="modal-body">
              
              <input type="hidden" id="xid_dokumen_kk" name="xid_dokumen_kk">
              
              <div class="mb-3">
                <label class="small mb-1" for="xid_kartu_keluarga">Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                <select name="xid_kartu_keluarga" class="form-control mb-1 select2" id="xid_kartu_keluarga">
                  <option value="">-- Pilih --</option>
                  <?php
                  $query_kartu_keluarga = mysqli_query($connection, 
                    "SELECT
                      a.id, a.nomor_kk, b.nama_lengkap
                    FROM tbl_kartu_keluarga AS a
                    LEFT JOIN tbl_penduduk AS b
                      ON b.nik = a.nik_kepala_keluarga
                    ORDER BY a.id DESC");
                  ?>

                  <?php while ($kartu_keluarga = mysqli_fetch_assoc($query_kartu_keluarga)): ?>
  
                    <option value="<?= $kartu_keluarga['id'] ?>"><?= "{$kartu_keluarga['nomor_kk']} -- {$kartu_keluarga['nama_lengkap']}" ?></option>
  
                  <?php endwhile ?>
                  <?php mysqli_close($connection) ?>
                </select>
                <small class="text-muted">Nama yang ditampilkan merupakan nama kepala keluarga.</small>
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
    <!--/.modal-input-dokumen-kk -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {
        
        // Re-init all feather icons
        feather.replace();

        const modalInputDokumenKKSelect = $('#ModalInputDokumenKK .select2');

        initSelect2(modalInputDokumenKKSelect, {
          width: '100%',
          dropdownParent: '#ModalInputDokumenKK .modal-content .modal-body'
        });
        

        $('.toggle_modal_tambah').on('click', function() {
          $('#ModalInputDokumenKK .modal-title').html(`<i data-feather="plus-circle" class="me-2 mt-1"></i>Tambah Dokumen KK`);
          $('#ModalInputDokumenKK form').attr({action: 'dokumen_kk_tambah.php', method: 'post'});

          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputDokumenKK').modal('show');
        });


        $('.datatables').on('click', '.toggle_modal_ubah', function() {
          const data = $(this).data();
          
          $('#ModalInputDokumenKK .modal-title').html(`<i data-feather="edit" class="me-2 mt-1"></i>Ubah Dokumen KK`);
          $('#ModalInputDokumenKK form').attr({action: 'dokumen_kk_ubah.php', method: 'post'});

          $('#ModalInputDokumenKK #xid_dokumen_kk').val(data.id_dokumen_kk);
          $('#ModalInputDokumenKK #xid_kartu_keluarga').val(data.id_kartu_keluarga).trigger('change');
          $('#ModalInputDokumenKK #xstatus_pengajuan').val(data.status_pengajuan).trigger('change');
          $('#ModalInputDokumenKK #xketerangan_pengajuan').val(data.keterangan_pengajuan);
          
          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputDokumenKK').modal('show');
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
          const id_dokumen_kk = $(this).data('id_dokumen_kk');
          const nomor_kk      = $(this).data('nomor_kk');
          const nama_lengkap  = $(this).data('nama_lengkap');
          
          Swal.fire({
            title: "Konfirmasi Tindakan?",
            html: `<div class="mb-1">Hapus data dokumen kk:</div><strong>(${nomor_kk}) -- ${nama_lengkap}?</strong>`,
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
                window.location = `dokumen_kk_hapus.php?xid_dokumen_kk=${id_dokumen_kk}`;
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
        ajax: `<?= base_url_return('admin/get_all_dokumen_kk.php') ?>`,
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
          {
            data: null,
            render: function ( data, type, row ) {
              return `<button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_modal_ubah"
                  data-id_dokumen_kk="${data.id_dokumen_kk}"
                  data-id_kartu_keluarga="${data.id_kartu_keluarga}"
                  data-status_pengajuan="${data.status_pengajuan}"
                  data-keterangan_pengajuan="${data.keterangan_pengajuan}">
                  <i class="fa fa-pen-to-square"></i>
                </button>
                <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_swal_hapus"
                  data-id_dokumen_kk="${data.id_dokumen_kk}"
                  data-nomor_kk="${data.nomor_kk}"
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