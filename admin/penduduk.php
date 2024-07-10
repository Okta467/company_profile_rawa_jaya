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

    <meta name="description" content="Data Penduduk" />
    <meta name="author" content="" />
    <title>Penduduk - <?= SITE_NAME ?></title>
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
                <h1 class="mb-0">Penduduk</h1>
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
                  <i class="far fa-address-card me-2 mt-1"></i>
                  Data Penduduk
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
                      <th>Warga Negara</th>
                      <th>Status validasi</th>
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
    
    <!--============================= MODAL INPUT PENDUDUK =============================-->
    <div class="modal fade" id="ModalInputPenduduk" tabindex="-1" role="dialog" aria-labelledby="ModalInputPendudukTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalInputPendudukTitle">Modal title</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <div class="modal-body">
              
              <input type="hidden" id="xid_penduduk" name="xid_penduduk">


              <div class="row gx-4">
                
                <div class="col-md-6 mb-3">
                  <label class="small mb-1" for="xnik">NIK <span class="text-danger">*</span></label>
                  <input type="text" name="xnik" minlength="16" maxlength="16" class="form-control" id="xnik" placeholder="Enter nik" required />
                </div>
              
                <div class="col-md-6 mb-3">
                  <label class="small mb-1" for="xid_kartu_keluarga">KK <small class="text-danger ms-3">(Tidak wajib diisi)</small></label>
                  <select name="xid_kartu_keluarga" class="form-control mb-1 select2" id="xid_kartu_keluarga">
                    <option value="">-- Pilih --</option>
                    <?php $query_kk = mysqli_query($connection, "SELECT * FROM tbl_kartu_keluarga ORDER BY nomor_kk ASC") ?>
                    <?php while ($kk = mysqli_fetch_assoc($query_kk)): ?>
    
                      <option value="<?= $kk['id'] ?>"><?= $kk['nomor_kk'] ?></option>
    
                    <?php endwhile ?>
                  </select>
                </div>

              </div>
              
            
              <div class="mb-3">
                <label class="small mb-1" for="xnama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="xnama_lengkap" class="form-control" id="xnama_lengkap" placeholder="Enter nama lengkap" required />
              </div>

              
              <div class="row gx-3">
    
                <div class="col-md-6">
                  <div class="form-check form-check-solid mb-3">
                    <input class="form-check-input" id="xjk_l" type="radio" name="xjk" value="l" checked required>
                    <label class="form-check-label" for="xjk_l">Laki-laki</label>
                  </div>
                </div>
    
                <div class="col-md-6">
                  <div class="form-check form-check-solid mb-3">
                    <input class="form-check-input" id="xjk_p" type="radio" name="xjk" value="p" required>
                    <label class="form-check-label" for="xjk_p">Perempuan</label>
                  </div>
                </div>
    
              </div>
            

              <div class="row gx-3">
              
                <div class="col-6 mb-3">
                  <label class="small mb-1" for="xtmp_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                  <input type="text" name="xtmp_lahir" class="form-control" id="xtmp_lahir" placeholder="Enter tempat lahir" required />
                </div>
              
                <div class="col-6 mb-3">
                  <label class="small mb-1" for="xtgl_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" name="xtgl_lahir" class="form-control" id="xtgl_lahir" required />
                </div>

              </div>


              <div class="row gx-3">
              
                <div class="col-6 mb-3">
                  <label class="small mb-1" for="xagama">Agama <span class="text-danger">*</span></label>
                  <select name="xagama" class="form-control mb-1 select2" id="xagama" required>
                    <option value="islam">Islam</option>
                    <option value="kristen_protestan">Kristen Protestan</option>
                    <option value="kristen_katolik">Kristen Katolik</option>
                    <option value="hindu">Hindu</option>
                    <option value="buddha">Buddha</option>
                    <option value="konghucu">Konghucu</option>
                    <option value="lainnya">Lainnya</option>
                  </select>
                </div>

                <div class="col-6 mb-3">
                  <label class="small mb-1" for="xwarga_negara">Warga Negara <span class="text-danger">*</span></label>
                  <select name="xwarga_negara" class="form-control mb-1 select2" id="xwarga_negara" required>
                    <option value="WNI">WNI</option>
                    <option value="WNA">WNA</option>
                  </select>
                </div>

              </div>
              

              <div class="mb-3">
                <label class="small mb-1" for="xpekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" name="xpekerjaan" class="form-control" id="xpekerjaan" placeholder="Enter pekerjaan" required />
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xalamat">Alamat <span class="text-danger">*</span></label>
                <input type="text" name="xalamat" class="form-control" id="xalamat" placeholder="Enter alamat" required />
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xemail">Email <span class="text-danger">*</span></label>
                <input type="text" name="xemail" class="form-control" id="xemail" placeholder="Enter email" autocomplete="email" required />
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xstatus_validasi">Status Validasi <span class="text-danger">*</span></label>
                <select name="xstatus_validasi" class="form-control mb-1 select2" id="xstatus_validasi" required>
                  <option value="belum_divalidasi">Belum Divalidasi</option>
                  <option value="sudah_divalidasi">Sudah Divalidasi</option>
                </select>
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xketerangan_validasi">Keterangan Validasi</label>
                <textarea class="form-control" id="xketerangan_valiadsi" name="xketerangan_valiadsi" rows="5" placeholder="Keterangan atau alasan dari status validasi" autocomplete="off"></textarea>
              </div>
                
            </div>
            <div class="modal-footer">
              <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button>
              <button class="btn btn-primary" id="toggle_swal_submit" type="submit">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--/.modal-input-penduduk -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {
        // // Datatables initialise
        // $('.datatables').DataTable({
        //   responsive: true,
        //   pageLength: 5,
        //   lengthMenu: [
        //     [3, 5, 10, 25, 50, 100],
        //     [3, 5, 10, 25, 50, 100],
        //   ]
        // });
        

        $('.toggle_modal_tambah').on('click', function() {
          $('#ModalInputPenduduk .modal-title').html(`<i data-feather="plus-circle" class="me-2 mt-1"></i>Tambah Penduduk`);
          $('#ModalInputPenduduk form').attr({action: 'penduduk_tambah.php', method: 'post'});

          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputPenduduk').modal('show');
        });


        $('.toggle_modal_ubah').on('click', function() {
          const id_penduduk = $(this).data('id_penduduk');
          
          $('#ModalInputPenduduk .modal-title').html(`<i data-feather="edit" class="me-2 mt-1"></i>Ubah Penduduk`);
          $('#ModalInputPenduduk form').attr({action: 'penduduk_ubah.php', method: 'post'});
          
          $.ajax({
            url: 'get_penduduk.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
              'id_penduduk': id_penduduk
            },
            success: function(data) {
              console.log(data)
              
              $('#ModalInputPenduduk #xid_penduduk').val(data[0].id_penduduk);
              $('#ModalInputPenduduk #xid_kartu_keluarga').val(data[0].id_kartu_keluarga).trigger('change');
              $('#ModalInputPenduduk #xnik').val(data[0].nik);
              $('#ModalInputPenduduk #xnama_lengkap').val(data[0].nama_lengkap);
              $('#ModalInputPenduduk #xjk').val(data[0].jk).prop('checked', true);
              $('#ModalInputPenduduk #xtmp_lahir').val(data[0].tmp_lahir);
              $('#ModalInputPenduduk #xtgl_lahir').val(data[0].tgl_lahir);
              $('#ModalInputPenduduk #xagama').val(data[0].agama).trigger('change');
              $('#ModalInputPenduduk #xwarga_negara').val(data[0].warga_negara).trigger('change');
              $('#ModalInputPenduduk #xpekerjaan').val(data[0].pekerjaan);
              $('#ModalInputPenduduk #xalamat').val(data[0].alamat);
              $('#ModalInputPenduduk #xemail').val(data[0].email);
              $('#ModalInputPenduduk #xstatus_validasi').val(data[0].status_validasi).trigger('change');
              $('#ModalInputPenduduk #xketerangan_validasi').val(data[0].keterangan_validasi);
              
              // Re-init all feather icons
              feather.replace();
              
              $('#ModalInputPenduduk').modal('show');
            },
            error: function(request, status, error) {
              // console.log("ajax call went wrong:" + request.responseText);
              console.log("ajax call went wrong:" + error);
            }
          });
        });
        

        $('.datatables').on('click', '.toggle_swal_hapus', function() {
          const id_penduduk   = $(this).data('id_penduduk');
          const nama_lengkap = $(this).data('nama_lengkap');
          
          Swal.fire({
            title: "Konfirmasi Tindakan?",
            html: `Hapus data penduduk: <strong>${nama_lengkap}?</strong>`,
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
                window.location = `penduduk_hapus.php?xid_penduduk=${id_penduduk}`;
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
        // `d` is the original data object for the row
        return (
          '<dl>' +
          '<dt>Keterangan Validasi:</dt>' +
          '<dd>' +
          d.keterangan_validasi +
          '<dt>Tempat, Tanggal Lahir:</dt>' +
          '<dd>' +
          d.tmp_lahir + ', ' + d.tgl_lahir +
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
        ajax: `<?= base_url_return('admin/get_all_penduduk.php') ?>`,
        order: [],
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
          { data: 'warga_negara' },
          {
            data: null,
            render: function( data, type, row ) {
              return data.status_validasi === 'sudah_divalidasi'
                ? `<span class="badge bg-green-soft text-green">Sudah Divalidasi</span>`
                : `<span class="badge bg-red-soft text-red">Belum Divalidasi</span>`;
            }
          },
          {
            data: null,
            render: function ( data, type, row ) {
              return `<button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_modal_ubah"
                  data-id_penduduk="${data.id_penduduk}">
                  <i class="fa fa-pen-to-square"></i>
                </button>
                <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_swal_hapus"
                  data-id_penduduk="${data.id_penduduk}"
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
    </script>

  </body>

  </html>

<?php endif ?>