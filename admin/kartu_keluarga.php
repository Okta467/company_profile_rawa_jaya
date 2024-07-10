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

    <meta name="description" content="Data Kartu Keluarga" />
    <meta name="author" content="" />
    <title>Kartu Keluarga - <?= SITE_NAME ?></title>
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
                <h1 class="mb-0">Kartu Keluarga</h1>
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
                  <i data-feather="users" class="me-2 mt-1"></i>
                  Data Kartu Keluarga
                </div>
                <button class="btn btn-sm btn-primary toggle_modal_tambah" type="button"><i data-feather="plus-circle" class="me-2"></i>Tambah Data</button>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>KK</th>
                      <th>Kepala Keluarga</th>
                      <th>Warga Negara</th>
                      <th>Pekerjaan</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query_kartu_keluarga = mysqli_query($connection, 
                      "SELECT
                        a.id AS id_kartu_keluarga, a.nomor_kk, a.nik_kepala_keluarga,
                        b.id AS id_penduduk, b.nik AS nik_kepala_keluarga, b.nama_lengkap AS nama_kepala_keluarga, b.jk, b.tmp_lahir, b.tgl_lahir, b.warga_negara, b.agama, b.pekerjaan, b.alamat, b.email, b.status_validasi AS status_validasi_penduduk, b.keterangan_validasi AS keterangan_validasi_penduduk
                      FROM tbl_kartu_keluarga AS a
                      LEFT JOIN tbl_penduduk AS b
                        ON b.nik = a.nik_kepala_keluarga
                      ORDER BY a.id DESC");

                    while ($kartu_keluarga = mysqli_fetch_assoc($query_kartu_keluarga)):
                    ?>

                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $kartu_keluarga['nomor_kk'] ?></td>
                        <td>
                          <?= htmlspecialchars($kartu_keluarga['nama_kepala_keluarga']); ?>
                          <?= !empty($kartu_keluarga['nik'])
                            ? "<br><small class='text-muted'>({$kartu_keluarga['nik_kepala_keluarga']})</small>"
                            : "<br><small class='text-muted'>(Tidak ada NIK)</small>"; ?>
                        </td>
                        <td><?= $kartu_keluarga['warga_negara'] ?></td>
                        <td><?= $kartu_keluarga['pekerjaan'] ?></td>
                        <td>
                          <div class="ellipsis toggle_tooltip" title="<?= $kartu_keluarga['alamat'] ?>">
                            <?= $kartu_keluarga['alamat'] ?>
                          </div>
                        </td>
                        <td>
                          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_modal_ubah"
                            data-id_kartu_keluarga="<?= $kartu_keluarga['id_kartu_keluarga'] ?>" 
                            data-nomor_kk="<?= $kartu_keluarga['nomor_kk'] ?>"
                            data-nik_kepala_keluarga="<?= $kartu_keluarga['nik_kepala_keluarga'] ?>"
                            data-nama_kepala_keluarga="<?= $kartu_keluarga['nama_kepala_keluarga'] ?>">
                            <i class="fa fa-pen-to-square"></i>
                          </button>
                          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_swal_hapus"
                            data-id_kartu_keluarga="<?= $kartu_keluarga['id_kartu_keluarga'] ?>" 
                            data-nomor_kk="<?= $kartu_keluarga['nomor_kk'] ?>"
                            data-nama_kepala_keluarga="<?= $kartu_keluarga['nama_kepala_keluarga'] ?>">
                            <i class="fa fa-trash-can"></i>
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
    
    <!--============================= MODAL INPUT KARTU KELUARGA =============================-->
    <div class="modal fade" id="ModalInputKartuKeluarga" tabindex="-1" role="dialog" aria-labelledby="ModalInputKartuKeluargaTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalInputKartu KeluargaTitle">Modal title</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <div class="modal-body">
              
              <input type="hidden" id="xid_kartu_keluarga" name="xid_kartu_keluarga">
            
              <div class="mb-3">
                <label class="small mb-1" for="xnomor_kk">Kartu Keluarga <span class="text-danger fw-bold">*</span></label>
                <input type="text" name="xnomor_kk" class="form-control" id="xnomor_kk" placeholder="Enter kartu_keluarga" required />
                <small class="text-danger">Harus unik, tidak boleh dengan data lainnya!</small>
              </div>
              
              <div class="mb-3" bis_skin_checked="1">
                <label class="small mb-1" for="xnik_kepala_keluarga">NIK Kepala Keluarga <span class="text-danger fw-bold">*</span></label>
                <select name="xnik_kepala_keluarga" class="form-control select2" id="xnik_kepala_keluarga" required>
                  <option value="">-- Pilih --</option>
                  <?php
                  $query_penduduk = mysqli_query($connection, 
                    "SELECT a.nama_lengkap, a.nik, b.nik_kepala_keluarga
                    FROM tbl_penduduk AS a
                    LEFT JOIN tbl_kartu_keluarga AS b
                      ON a.nik = b.nik_kepala_keluarga
                    WHERE a.id_kartu_keluarga IS NULL AND b.nik_kepala_keluarga IS NULL");
                  
                  $penduduks = mysqli_fetch_all($query_penduduk, MYSQLI_ASSOC);
                  ?>
                    
                  <?php foreach($penduduks as $penduduk): ?>

                    <option value="<?= $penduduk['nik'] ?>"><?= "({$penduduk['nik']}) -- {$penduduk['nama_lengkap']}" ?></option>

                  <?php endforeach ?>
                </select>
                <small class="text-danger">NIK yang muncul hanya yang belum menjadi kepala keluarga dan tidak termasuk ke dalam kartu keluarga tertentu.</small>
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
    <!--/.modal-input-kartu-keluarga -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>
    
    <!-- PAGE SCRIPT -->
    <script>
      $(document).ready(function() {
        
        const nikKepalaKeluargaSelect = $('#xnik_kepala_keluarga');
        
        // Initialize Select2
        initSelect2(nikKepalaKeluargaSelect, {
          width: '100%',
          dropdownParent: "#ModalInputKartuKeluarga .modal-content .modal-body"
        });

          
        $('.toggle_modal_tambah').on('click', function() {
          $('#ModalInputKartuKeluarga .modal-title').html(`<i data-feather="plus-circle" class="me-2 mt-1"></i>Tambah Kartu Keluarga`);
          $('#ModalInputKartuKeluarga form').attr({action: 'kartu_keluarga_tambah.php', method: 'post'});

          $.ajax({
            url: 'get_all_penduduk_with_no_kartu_keluarga.php',
            dataType: 'JSON',
            success: function(penduduks) {
              nikKepalaKeluargaSelect.empty();
              
              // Append options to the select element
              penduduks.forEach(function(item) {
                let id = item.nik;
                let text = `(${item.nik}) -- ${item.nama_lengkap}`
                
                const option = new Option(text, id);
                nikKepalaKeluargaSelect.append(option);
              });

              // Re-init all feather icons
              feather.replace();
              
              $('#ModalInputKartuKeluarga').modal('show');
            },
            error: function(request, status, error) {
              // console.log("ajax call went wrong:" + request.responseText);
              console.log("ajax call went wrong:" + error);
            }
          });
        });


        $('.toggle_modal_ubah').on('click', function() {
          const id_kartu_keluarga = $(this).data('id_kartu_keluarga');
          const nomor_kk = $(this).data('nomor_kk');
          const nik_kepala_keluarga = $(this).data('nik_kepala_keluarga');
          const nama_kepala_keluarga = $(this).data('nama_kepala_keluarga');
          
          $('#ModalInputKartuKeluarga .modal-title').html(`<i data-feather="edit" class="me-2 mt-1"></i>Ubah Kartu Keluarga`);
          $('#ModalInputKartuKeluarga form').attr({action: 'kartu_keluarga_ubah.php', method: 'post'});

          $('#ModalInputKartuKeluarga #xid_kartu_keluarga').val(id_kartu_keluarga);
          $('#ModalInputKartuKeluarga #xnomor_kk').val(nomor_kk);
          $('#ModalInputKartuKeluarga #xnik_kepala_keluarga').val(nik_kepala_keluarga).trigger('change');

          nikKepalaKeluargaSelect.empty();
          
          const data = {id: nik_kepala_keluarga, text: `(${nik_kepala_keluarga}) -- ${nama_kepala_keluarga}`};
          
          // Append options to the select element
          const option = new Option(data.text, data.id);
          nikKepalaKeluargaSelect.append(option);

          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputKartuKeluarga').modal('show');
        });
        

        $('#datatablesSimple').on('click', '.toggle_swal_hapus', function() {
          const id_kartu_keluarga = $(this).data('id_kartu_keluarga');
          const nomor_kk = $(this).data('nomor_kk');
          const nama_kepala_keluarga = $(this).data('nama_kepala_keluarga');
          
          Swal.fire({
            title: "Konfirmasi Tindakan?",
            html: `<div class="mb-1">Hapus data kartu_keluarga: </div><strong>(${nomor_kk}) ${nama_kepala_keluarga}?</strong>`,
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
                window.location = `kartu_keluarga_hapus.php?xid_kartu_keluarga=${id_kartu_keluarga}`;
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