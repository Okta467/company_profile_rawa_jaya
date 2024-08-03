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

    <meta name="description" content="Data Profil" />
    <meta name="author" content="" />
    <title>Profil - <?= SITE_NAME ?></title>
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
                <h1 class="mb-0">Profil</h1>
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
                  <i data-feather="user" class="me-2 mt-1"></i>
                  Data Profil
                </div>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama/NIP</th>
                      <th>Pangkat/Golongan</th>
                      <th><div class="text-center">Status</div></th>
                      <th>Ijazah/Mapel/Tahun</th>
                      <th>Ubah Profil <br>/ Detail</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $no = 1;
                    $query_kepala_desa = mysqli_query($connection, 
                      "SELECT
                        a.id AS id_kepala_desa, a.nip, a.nama_kepala_desa, a.jk, a.alamat, a.tmp_lahir, a.tgl_lahir, a.tahun_ijazah,
                        c.id AS id_pangkat_golongan, c.nama_pangkat_golongan, c.tipe AS tipe_pangkat_golongan,
                        d.id AS id_pendidikan, d.nama_pendidikan,
                        e.id AS id_jurusan_pendidikan, e.nama_jurusan AS nama_jurusan_pendidikan,
                        f.id AS id_pengguna, f.username, f.hak_akses
                      FROM tbl_kepala_desa AS a
                      LEFT JOIN tbl_pangkat_golongan AS c
                        ON a.id_pangkat_golongan = c.id
                      LEFT JOIN tbl_pendidikan AS d
                        ON a.id_pendidikan = d.id
                      LEFT JOIN tbl_jurusan_pendidikan AS e
                        ON a.id_jurusan_pendidikan = e.id
                      LEFT JOIN tbl_pengguna AS f
                        ON a.id_pengguna = f.id
                      WHERE a.id = {$_SESSION['id_kepala_desa']}");

                    while ($kepala_desa = mysqli_fetch_assoc($query_kepala_desa)):
                    ?>

                      <tr>
                        <td><?= $no++ ?></td>
                        <td>
                          <?= htmlspecialchars($kepala_desa['nama_kepala_desa']); ?>
                          <?= !empty($kepala_desa['nip'])
                            ? "<br><small class='text-muted'>({$kepala_desa['nip']})</small>"
                            : "<br><small class='text-muted'>(Tidak ada NIP)</small>"; ?>
                        </td>
                        <td>
                          <div class="ellipsis toggle_tooltip" title="<?= $kepala_desa['nama_pangkat_golongan'] ?>">
                            <?= $kepala_desa['nama_pangkat_golongan'] ?>
                          </div>
                        </td>
                        <td>
                          <div class="text-center"><?= strtoupper($kepala_desa['tipe_pangkat_golongan']) ?></div>
                        </td>
                        <td>
                          <?= "{$kepala_desa['nama_pendidikan']}/{$kepala_desa['nama_jurusan_pendidikan']}/{$kepala_desa['tahun_ijazah']}" ?>
                        </td>
                        <td>
                          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_modal_ubah" type="button"
                            data-id_kepala_desa="<?= $kepala_desa['id_kepala_desa'] ?>">
                            <i class="fa fa-pen-to-square"></i>
                          </button>
                          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2 toggle_modal_detail_kepala_desa" type="button"
                            data-id_kepala_desa="<?= $kepala_desa['id_kepala_desa'] ?>"
                            data-nama_kepala_desa="<?= $kepala_desa['nama_kepala_desa'] ?>"
                            data-username="<?= $kepala_desa['username'] ?>"
                            data-hak_akses="<?= $kepala_desa['hak_akses'] ?>"
                            data-alamat="<?= $kepala_desa['alamat'] ?>"
                            data-tmp_lahir="<?= $kepala_desa['tmp_lahir'] ?>"
                            data-tgl_lahir="<?= $kepala_desa['tgl_lahir'] ?>">
                            <i class="fa fa-list"></i>
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
    
    <!--============================= MODAL DETAIL GURU =============================-->
    <div class="modal fade" id="ModalDetailProfil" tabindex="-1" role="dialog" aria-labelledby="ModalDetailProfil" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail Profil</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <div class="p-4">
              <h4><i data-feather="star" class="me-2"></i>Profil</h4>
              <p class="mb-0 xnama_kepala_desa"></p>
            </div>
            
            <div class="p-4">
              <h4><i data-feather="key" class="me-2"></i>Username</h4>
              <p class="mb-0 xusername"></p>
            </div>
            
            <div class="p-4">
              <h4><i data-feather="key" class="me-2"></i>Hak Akses</h4>
              <p class="mb-0 xhak_akses"></p>
            </div>
            
            <div class="p-4">
              <h4><i data-feather="home" class="me-2"></i>Alamat</h4>
              <p class="mb-0 xalamat"></p>
            </div>
            
            <div class="p-4">
              <h4><i data-feather="gift" class="me-2"></i>Tempat, Tanggal Lahir</h4>
              <p class="mb-0 xtmp_tgl_lahir"></p>
            </div>
          
          </div>
          <div class="modal-footer">
            <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    <!--/.modal-detail-kepala_desa -->
      
    <!--============================= MODAL INPUT JURUSAN =============================-->
    <div class="modal fade" id="ModalInputProfil" tabindex="-1" role="dialog" aria-labelledby="ModalInputProfilTitle" aria-hidden="true" data-focus="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalInputProfilTitle">Modal title</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <div class="modal-body">
    
              <input type="hidden" name="xid_kepala_desa" id="xid_kepala_desa" required>
              <input type="hidden" name="xid_pengguna" id="xid_pengguna" required>
    
              <div class="mb-3">
                <label class="small mb-1" for="xnip">NIP (18 Digit) <span class="text-danger fw-bold">*</span></label>
                <input class="form-control mb-1" id="xnip" type="text" name="xnip" minlength="18" maxlength="18" placeholder="Enter NIP" disabled>
              </div>
    
              <div class="mb-3">
                <label class="small mb-1" for="xnama_kepala_desa">Nama Guru <span class="text-danger fw-bold">*</span></label>
                <input class="form-control" id="xnama_kepala_desa" type="text" name="xnama_kepala_desa" placeholder="Enter nama kepala_desa" disabled>
              </div>
    
              <div class="mb-3">
                <label class="small mb-1" for="xpassword">Password <span class="text-danger fw-bold">*</span></label>
                <div class="input-group input-group-joined mb-1">
                  <input class="form-control mb-1" id="xpassword" type="password" name="xpassword" placeholder="Enter password" autocomplete="new-password" required>
                  <button class="input-group-text" id="xpassword_toggle" type="button"><i class="fa-regular fa-eye"></i></button>
                </div>
                <small class="text-muted" id="xpassword_help"></small>
              </div>
              
              <div class="mb-3">
                <label class="small mb-1" for="xhak_akses">Hak Akses <span class="text-danger fw-bold">*</span></label>
                <select name="xhak_akses" class="form-control select2" id="xhak_akses" disabled>
                  <option value="kepala_desa" selected>Kepala Desa</option>
                </select>
              </div>
    
    
              <div class="row gx-3">
    
                <div class="col-md-6">
                  <div class="form-check form-check-solid mb-3">
                    <input class="form-check-input" id="xjk_l" type="radio" name="xjk" value="l" checked disabled>
                    <label class="form-check-label" for="xjk_l">Laki-laki</label>
                  </div>
                </div>
    
                <div class="col-md-6">
                  <div class="form-check form-check-solid mb-3">
                    <input class="form-check-input" id="xjk_p" type="radio" name="xjk" value="p" disabled>
                    <label class="form-check-label" for="xjk_p">Perempuan</label>
                  </div>
                </div>
    
              </div>
    
    
              <div class="mb-3">
                <label class="small mb-1" for="xalamat">Alamat <span class="text-danger fw-bold">*</span></label>
                <input class="form-control" id="xalamat" type="text" name="xalamat" placeholder="Enter alamat" required>
              </div>
    
    
              <div class="row gx-3">
    
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="small mb-1" for="xtmp_lahir">Tempat Lahir</label>
                    <input class="form-control" id="xtmp_lahir" type="text" name="xtmp_lahir" placeholder="Enter tempat lahir" required>
                  </div>
                </div>
    
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="small mb-1" for="xtgl_lahir">Tanggal Lahir</label>
                    <input class="form-control" id="xtgl_lahir" type="date" name="xtgl_lahir" required>
                  </div>
                </div>
    
              </div>

    
              <div class="mb-3">
                <label class="small mb-1" for="xid_pangkat_golongan">Pangkat/Golongan</label>
                <select name="xid_pangkat_golongan" class="form-control select2" id="xid_pangkat_golongan" required>
                  <option value="">-- Pilih --</option>
                  <?php $query_pangkat_golongan = mysqli_query($connection, "SELECT * FROM tbl_pangkat_golongan") ?>
                  <?php while ($pangkat_golongan = mysqli_fetch_assoc($query_pangkat_golongan)) : ?>
    
                    <option value="<?= $pangkat_golongan['id'] ?>"><?= $pangkat_golongan['nama_pangkat_golongan'] ?></option>
    
                  <?php endwhile ?>
                </select>
              </div>
    
    
              <div class="row gx-3">
    
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="small mb-1" for="xid_pendidikan">Pendidikan</label>
                    <select name="xid_pendidikan" class="form-control select2" id="xid_pendidikan" required>
                      <option value="">-- Pilih --</option>
                      <?php $query_pendidikan = mysqli_query($connection, "SELECT * FROM tbl_pendidikan WHERE nama_pendidikan NOT IN ('SD', 'SMP', 'sd', 'smp', 'tidak_sekolah')") ?>
                      <?php while ($pendidikan = mysqli_fetch_assoc($query_pendidikan)) : ?>
    
                        <option value="<?= $pendidikan['id'] ?>"><?= $pendidikan['nama_pendidikan'] ?></option>
    
                      <?php endwhile ?>
                    </select>
                  </div>
                </div>
    
                <div class="col-md-8">
                  <div class="mb-3">
                    <label class="small mb-1" for="xid_jurusan">Jurusan</label>
                    <span class="form-control text-danger xid_jurusan">Pilih pendidikan terlebih dahulu!</span>
                  </div>
                </div>
    
              </div>
    
    
              <div class="mb-3">
                <label class="small mb-1" for="xtahun_ijazah">Tahun Ijazah<span class="text-danger fw-bold">*</span></label>
                <input class="form-control" id="xtahun_ijazah" type="number" min="1900" max="2100" name="xtahun_ijazah" placeholder="Enter username" required>
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
    <!--/.modal-input-jurusan -->
    
    <?php include '_partials/script.php' ?>
    <?php include '../helpers/sweetalert2_notify.php' ?>

    <!-- PAGE SCRIPT -->
    <script>
        let password = document.getElementById('xpassword');
        let passwordConfirm = document.getElementById('xpassword_confirm');
    
        let passwordToggle = document.getElementById('xpassword_toggle');
        let passwordConfirmToggle = document.getElementById('xpassword_confirm_toggle');
    
        let passwordHelp = document.getElementById('xpassword_help');
        let passwordConfirmHelp = document.getElementById('xpassword_confirm_help');
        
        passwordToggle.addEventListener('click', function() {
          initTogglePassword(password, passwordToggle);
        });
    </script>

    <script>
      $(document).ready(function() {
        
        const selectModalInputProfil = $('#ModalInputProfil .select2');
        initSelect2(selectModalInputProfil, {
          width: '100%',
          dropdownParent: "#ModalInputProfil .modal-content .modal-body"
        });

        
        $('.toggle_modal_ubah').on('click', function() {
          const id_kepala_desa   = $(this).data('id_kepala_desa');
          const nama_kepala_desa = $(this).data('nama_kepala_desa');
          
          $('#ModalInputProfil .modal-title').html(`<i data-feather="edit" class="me-2 mt-1"></i>Ubah Profil`);
          $('#ModalInputProfil form').attr({action: 'profil_ubah.php', method: 'post'});
          $('#ModalInputProfil #xpassword').attr('required', false);
          $('#ModalInputProfil #xpassword_help').html('Kosongkan jika tidak ingin ubah password.');
        
          $.ajax({
            url: 'get_kepala_desa.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
              'id_kepala_desa': id_kepala_desa
            },
            success: function(data) {
              console.log(data)
              $('#ModalInputProfil #xid_kepala_desa').val(data[0].id_kepala_desa);
              $('#ModalInputProfil #xid_pengguna').val(data[0].id_pengguna);
              $('#ModalInputProfil #xnip').val(data[0].nip);
              $('#ModalInputProfil #xnama_kepala_desa').val(data[0].nama_kepala_desa);
              $('#ModalInputProfil #xhak_akses').val(data[0].hak_akses).trigger('change');
              $(`#ModalInputProfil input[name="xjk"][value="${data[0].jk}"]`).prop('checked', true)
              $('#ModalInputProfil #xalamat').val(data[0].alamat);
              $('#ModalInputProfil #xtmp_lahir').val(data[0].tmp_lahir);
              $('#ModalInputProfil #xtgl_lahir').val(data[0].tgl_lahir);
              $('#ModalInputProfil #xtahun_ijazah').val(data[0].tahun_ijazah);
              $('#ModalInputProfil .select2#xid_pangkat_golongan').val(data[0].id_pangkat_golongan).trigger('change');
              $('#ModalInputProfil .select2#xid_pendidikan').val(data[0].id_pendidikan).trigger('change');
              // input jurusan already filled in xid_pendidikan on click event below
              
              $('#ModalInputProfil').modal('show');
            },
            error: function(request, status, error) {
              // console.log("ajax call went wrong:" + request.responseText);
              console.log("ajax call went wrong:" + error);
            }
          })
          
          $('#ModalInputProfil #xid_kepala_desa').val(id_kepala_desa);
          $('#ModalInputProfil #xnama_kepala_desa').val(nama_kepala_desa);
        
          // Re-init all feather icons
          feather.replace();
          
          $('#ModalInputProfil').modal('show');
        });

        
        $('.toggle_modal_detail_kepala_desa').on('click', function() {
          const data = $(this).data();
        
          $('#ModalDetailProfil .xnama_kepala_desa').html(data.nama_kepala_desa);
          $('#ModalDetailProfil .xusername').html(data.username || 'Tidak ada (akun belum dibuat)');
          $('#ModalDetailProfil .xhak_akses').html(data.hak_akses || 'Tidak ada (akun belum dibuat)');
          $('#ModalDetailProfil .xalamat').html(data.alamat);
          $('#ModalDetailProfil .xtmp_tgl_lahir').html(`${data.tmp_lahir}, ${moment(data.tgl_lahir).format("DD MMMM YYYY")}`);
        
          $('#ModalDetailProfil').modal('show');
        });
        

        const formSubmitBtn = $('#toggle_swal_submit');
        const eventName = 'click';
        
        toggleSwalSubmit(formSubmitBtn, eventName);
        
        
        $('#xid_pendidikan').on('change', function() {
          const id_pendidikan = $(this).val();
          const nama_pendidikan = $(this).find('option:selected').text();
        
          $.ajax({
            url: 'get_jurusan_pendidikan.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
              'id_pendidikan' : id_pendidikan,
            },
            success: function(data) {
              if (!id_pendidikan) {
                $('#ModalInputProfil span.xid_jurusan').html('Pilih pendidikan terlebih dahulu!');
                $('#ModalInputProfil span.xid_jurusan').removeClass('form-control'); // to make sure there's no form-control before adding new one
                $('#ModalInputProfil span.xid_jurusan').addClass('form-control');
                $('#ModalDaftarJurusan').modal('show');
                return;
              }
        
              if (['tidak_sekolah', 'sd', 'smp', 'sltp'].includes(nama_pendidikan.toLowerCase())) {
                $('#ModalInputProfil span.xid_jurusan').html('Tidak perlu diisi.');
                $('#ModalInputProfil span.xid_jurusan').removeClass('form-control'); // to make sure there's no form-control before adding new one
                $('#ModalInputProfil span.xid_jurusan').addClass('form-control');
                $('#ModalDaftarJurusan').modal('show');
                return;
              }
        
              // set select html for select2 initialization
              const jurusan_select2_html = `<select name="xid_jurusan" class="form-control form-control-sm select2 xid_jurusan" id="xid_jurusan" required style="width: 100%"></select>`;
              
              // Clear text and specific style for span id jurusan
              $('#ModalInputProfil span.xid_jurusan').html(jurusan_select2_html);
              $('#ModalInputProfil span.xid_jurusan').removeClass('form-control');
        
              // Transform the data to the format that Select2 expects
              var transformedData = data.map(item => ({
                  id: item.id_jurusan,
                  text: item.nama_jurusan
              }));
              
              const jurusanSelect = $('select#xid_jurusan');
              jurusanSelect.select2({ 'width': '100%' });
              
              // Clear the select element
              jurusanSelect.html(null);
              
              // Set the transformed data to the select element using select2 method
              initSelect2(jurusanSelect, {
                width: '100%',
                dropdownParent: ".modal-content .modal-body",
                data: transformedData
              });
              
              $('#ModalDaftarJurusan').modal('show');
            },
            error: function(request, status, error) {
              // console.log("ajax call went wrong:" + request.responseText);
              console.log("ajax call went wrong:" + error);
            }
          })
        });
        
      });
    </script>

  </body>

  </html>

<?php endif ?>