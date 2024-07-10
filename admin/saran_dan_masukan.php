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

    <meta name="description" content="Data Saran dan Masukan" />
    <meta name="author" content="" />
    <title>Saran dan Masukan - <?= SITE_NAME ?></title>
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
                <h1 class="mb-0">Saran dan Masukan</h1>
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
                  <i data-feather="inbox" class="me-2 mt-1"></i>
                  Data Saran dan Masukan
                </div>
                <button class="btn btn-sm btn-primary toggle_modal_tambah" type="button"><i data-feather="plus-circle" class="me-2"></i>Tambah Data</button>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Pengirim</th>
                      <th>Email</th>
                      <th>Perihal</th>
                      <th>Status</th>
                      <th>Pesan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query_saran_dan_masukan = mysqli_query($connection, "SELECT *  FROM tbl_saran_dan_masukan ORDER BY id DESC");

                    while ($saran_dan_masukan = mysqli_fetch_assoc($query_saran_dan_masukan)):
                    ?>

                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $saran_dan_masukan['nama_lengkap'] ?></td>
                        <td><?= $saran_dan_masukan['email'] ?></td>
                        <td><?= $saran_dan_masukan['perihal'] ?></td>
                        <td>
                          <?php if(!$saran_dan_masukan['status_dibaca']): ?>
                            
                            <span class="badge bg-red-soft text-red" id="<?= 'status_dibaca_' . $saran_dan_masukan['id'] ?>">Belum Dibaca</span>
                          
                          <?php else: ?>
                            
                            <span class="badge bg-green-soft text-green" id="<?= 'status_dibaca_' . $saran_dan_masukan['id'] ?>">Sudah Dibaca</span>

                          <?php endif ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-xs rounded-pill btn-outline-primary toggle_modal_pesan" data-id_saran_dan_masukan="<?= $saran_dan_masukan['id'] ?>" data-pesan="<?= htmlspecialchars($saran_dan_masukan['pesan']) ?>">
                            <i data-feather="inbox" class="me-1"></i>
                            Lihat Pesan
                          </button>
                        </td>
                        <td>
                          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_modal_ubah"
                            data-id_saran_dan_masukan="<?= $saran_dan_masukan['id'] ?>" 
                            data-nama_lengkap="<?= $saran_dan_masukan['nama_lengkap'] ?>"
                            data-email="<?= $saran_dan_masukan['email'] ?>"
                            data-perihal="<?= $saran_dan_masukan['perihal'] ?>"
                            data-status_dibaca="<?= $saran_dan_masukan['status_dibaca'] ?>"
                            data-pesan="<?= $saran_dan_masukan['pesan'] ?>">
                            <i class="fa fa-pen-to-square"></i>
                          </button>
                          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_swal_hapus"
                            data-id_saran_dan_masukan="<?= $saran_dan_masukan['id'] ?>" 
                            data-nama_lengkap="<?= $saran_dan_masukan['nama_lengkap'] ?>">
                            <i class="fa fa-trash-can"></i>
                          </button>
                          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 reset_status_dibaca" title="Tandai sbg. belum dibaca"
                            data-id_saran_dan_masukan="<?= $saran_dan_masukan['id'] ?>">
                            <i class="fa fa-repeat"></i>
                          </button>
                        </td>
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
    
    <!--============================= MODAL PESAN SARAN DAN MASUKAN =============================-->
    <div class="modal fade" id="ModalPesanSaranDanMasukan" tabindex="-1" role="dialog" aria-labelledby="ModalPesanSaranDanMasukan" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Saran dan Masukan</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <div id="pesan_saran_dan_masukan"></div>
            
          </div>
          <div class="modal-footer">
            <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    <!--/.modal-pesan-saran-dan-masukan -->
    
    <!--============================= MODAL INPUT SARAN DAN MASUKAN =============================-->
    <div class="modal fade" id="ModalInputSarandanMasukan" tabindex="-1" role="dialog" aria-labelledby="ModalInputSarandanMasukanTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalInputSarandanMasukanTitle">Modal title</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <div class="modal-body">
              
              <input type="hidden" id="xid_saran_dan_masukan" name="xid_saran_dan_masukan">
            
              <div class="row gx-6">
              
                <div class="mb-3 col-6">
                  <label class="small mb-1" for="xnama_lengkap">Nama Lengkap</label>
                  <input type="text" name="xnama_lengkap" class="form-control" id="xnama_lengkap" placeholder="Enter nama lengkap" autocomplete="name" required />
                </div>
              
                <div class="mb-3 col-6">
                  <label class="small mb-1" for="xemail">Email</label>
                  <input type="text" name="xemail" class="form-control" id="xemail" placeholder="Enter email" autocomplete="email" required />
                </div>

              </div>

            
              <div class="mb-3">
                <label class="small mb-1" for="xperihal">Perihal</label>
                <input type="text" name="xperihal" class="form-control" id="xperihal" placeholder="Enter perihal" required />
              </div>

            
              <div class="mb-3">
                <label class="small mb-1" for="xstatus_dibaca">Status Dibaca</label>
                <select name="xstatus_dibaca" class="form-control select2" id="xstatus_dibaca" required>
                  <option value="0">Belum Dibaca</option>
                  <option value="1">Sudah Dibaca</option>
                </select>
              </div>
                
              <div class="mb-3">
                <label class="small mb-1" for="xpesan">Saran dan Masukan</label>
                <textarea class="form-control" id="xpesan" name="xpesan" rows="5" placeholder="Enter saran dan masukan" autocomplete="off" required></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button>
              <button class="btn btn-primary" type="submit" id="toggle_swal_submit">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--/.modal-input-saran_dan_masukan -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {

        const selectStatusDibaca = $('#xstatus_dibaca');

        initSelect2(selectStatusDibaca, {
          width: '100%',
          dropdownParent: "#ModalInputSarandanMasukan"
        });


        let setStatusDibacaSaranDanMasukan = function(id_saran_dan_masukan, status_dibaca, callback) {
          $.ajax({
            url: 'set_status_dibaca_saran_dan_masukan.php',
            method: 'poST',
            data: {
              id_saran_dan_masukan: id_saran_dan_masukan,
              status_dibaca: status_dibaca
            },
            dataType: 'JSON',
            success: function(update_success) {
              callback(update_success);
            },
            error: function(request, status, error) {
              // console.log("ajax call went wrong:" + request.responseText);
              console.log("ajax call went wrong:" + error);
            }
          })
        }


        $('.toggle_modal_pesan').on('click', function() {
          const id_saran_dan_masukan = $(this).data('id_saran_dan_masukan');
          const status_dibaca = 1;
          const pesan = $(this).data('pesan');

          setStatusDibacaSaranDanMasukan(id_saran_dan_masukan, status_dibaca, function(success) {
            if (success) {
              $(`#status_dibaca_${id_saran_dan_masukan}`).attr('class', 'badge bg-green-soft text-green');
              $(`#status_dibaca_${id_saran_dan_masukan}`).text('Sudah Dibaca');
            }
          });
          
          $('#ModalPesanSaranDanMasukan #pesan_saran_dan_masukan').html(pesan);

          $('#ModalPesanSaranDanMasukan').modal('show');
        });
        

        $('.reset_status_dibaca').on('click', function() {
          const id_saran_dan_masukan = $(this).data('id_saran_dan_masukan');
          const status_dibaca = 0;
          
          setStatusDibacaSaranDanMasukan(id_saran_dan_masukan, status_dibaca, function(success) {
            if (success) {
              $(`#status_dibaca_${id_saran_dan_masukan}`).attr('class', 'badge bg-red-soft text-red');
              $(`#status_dibaca_${id_saran_dan_masukan}`).text('Belum Dibaca');
            }
          });
        });
        
        
        $('.toggle_modal_tambah').on('click', function() {
          $('#ModalInputSarandanMasukan .modal-title').html(`<i data-feather="plus-circle" class="me-2 mt-1"></i>Tambah Saran dan Masukan`);
          $('#ModalInputSarandanMasukan form').attr({action: 'saran_dan_masukan_tambah.php', method: 'post'});

          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputSarandanMasukan').modal('show');
        });


        $('.toggle_modal_ubah').on('click', function() {
          const data = $(this).data();
          
          $('#ModalInputSarandanMasukan .modal-title').html(`<i data-feather="edit" class="me-2 mt-1"></i>Ubah Saran dan Masukan`);
          $('#ModalInputSarandanMasukan form').attr({action: 'saran_dan_masukan_ubah.php', method: 'post'});

          $('#ModalInputSarandanMasukan #xid_saran_dan_masukan').val(data.id_saran_dan_masukan);
          $('#ModalInputSarandanMasukan #xnama_lengkap').val(data.nama_lengkap);
          $('#ModalInputSarandanMasukan #xemail').val(data.email);
          $('#ModalInputSarandanMasukan #xperihal').val(data.perihal);
          $('#ModalInputSarandanMasukan #xstatus_dibaca').val(data.status_dibaca).trigger('change');
          $('#ModalInputSarandanMasukan #xpesan').val(data.pesan);

          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputSarandanMasukan').modal('show');
        });
        

        $('#datatablesSimple').on('click', '.toggle_swal_hapus', function() {
          const id_saran_dan_masukan   = $(this).data('id_saran_dan_masukan');
          const nama_saran_dan_masukan = $(this).data('nama_saran_dan_masukan');
          
          Swal.fire({
            title: "Konfirmasi Tindakan?",
            html: `Hapus data saran_dan_masukan: <strong>${nama_saran_dan_masukan}?</strong>`,
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
                window.location = `saran_dan_masukan_hapus.php?xid_saran_dan_masukan=${id_saran_dan_masukan}`;
              });
            }
          });
        });
        

        const formSubmitBtn = $('#toggle_swal_submit');
        const eventName = 'click';
        toggleSwalSubmit(formSubmitBtn, eventName);
        
      });
    </script>

  </body>

  </html>

<?php endif ?>