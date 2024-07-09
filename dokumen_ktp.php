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
          <li>Dokumen KTP</li>
        </ol>
        <h2>Dokumen KTP</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container contact">
        <div class="row">
          <div class="col-6 mb-4">
            <h4><i class="bx bx-id-card me-2"></i>Data Dokumen KTP</h4>
          </div>
          <div class="col-6 mb-4 d-inline-flex justify-content-end align-items-center">
            <button class="btn btn-sm btn-outline-primary rounded-pill toggle_modal_tambah_penduduk"><i data-feather="plus-circle" class="me-1 mb-1"></i>Penduduk Baru</button>
            <button class="btn btn-sm btn-outline-primary rounded-pill ms-3 toggle_modal_tambah_dokumen_ktp"><i data-feather="plus-circle" class="me-1 mb-1"></i>Pengajuan Baru</button>
            <button class="btn btn-sm btn-outline-primary rounded-pill ms-3 toggle_modal_cari_by_nik"><i data-feather="search" class="me-1 mb-1"></i>Cari Berdasarkan NIK</button>
          </div>
          <small class="text-muted">Silakan gunakan <strong>Penduduk Baru</strong> jika nama Anda tidak ada pada <strong>tabel di bawah ini</strong> atau NIK tidak ditemukan pada <strong>Pengajuan Baru</strong> dan <strong>Cari Berdasarkan NIK</strong>.</small>
          <small class="mb-4 text-muted">
            Dengan menambahkan diri Anda sebagai penduduk baru, Anda dapat melakukan pengajuan lain seperti:
            <a class="btn-link" href="index.php#administrasi">Surat Domisili</a>, 
            <a class="btn-link" href="index.php#administrasi">Surat Keramaian</a>, 
            <a class="btn-link" href="index.php#administrasi">Dokumen KK</a>, 
            <a class="btn-link" href="index.php#sosial">dan Bantuan Sosial</a>.
          </small>
          <table class="table table-hover table-bordered datatables" id="tabel_dokumen_ktp" cellspacing="0" width="100%" style="font-size: 0.875rem">
            <thead>
              <tr>
                <th></th>
                <th class="text-start">#</th>
                <th>Nama</th>
                <th>Warga Negara</th>
                <th>Pekerjaan</th>
                <th>Status Pengajuan</th>
                <th>Tanggal Pengajuan</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'index_footer.php' ?>
  <!-- End Footer -->

  <div id="preloader"></div> <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

  <!--============================= MODAL INPUT PENGAJUAN BARU =============================-->
  <div class="modal fade" id="ModalInputPengajuanBaru" tabindex="-1" role="dialog" aria-labelledby="ModalInputPengajuanBaru" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
          <div class="modal-body">
            
            <div class="mb-3">
              <label class="small mb-1" for="xnik_pengajuan_baru">NIK</label>
              <input type="text" name="xnik_pengajuan_baru" class="form-control" id="xnik_pengajuan_baru" placeholder="Enter nik" required />
              <small class="text-danger d-none" id="xnik_pengajuan_baru_help">NIK tidak ada, silakan input penduduk baru.</small>
            </div>
            
          </div>
          <div class="modal-footer">
            <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
            <button class="btn btn-primary toggle_swal_submit" type="submit" name="xsubmit">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!--/.modal-input-pengajuan-baru -->
    
  <!--============================= MODAL INPUT PENDUDUK BARU =============================-->
  <div class="modal fade" id="ModalInputPendudukBaru" tabindex="-1" role="dialog" aria-labelledby="ModalInputPendudukBaruTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalInputPendudukBaruTitle">Modal title</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
          <div class="modal-body">
            
            <div class="mb-3">
              <label class="small mb-1" for="xnik_penduduk_baru">NIK <span class="text-danger">*</span></label>
              <input type="text" name="xnik_penduduk_baru" minlength="16" maxlength="16" class="form-control" id="xnik_penduduk_baru" placeholder="Enter nik" required />
              <small class="text-danger d-none" id="xnik_penduduk_baru_help">NIK sudah ada! data tidak akan disimpan saat submit.</small>
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

          </div>
          <div class="modal-footer">
            <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary toggle_swal_submit" type="submit" name="xsubmit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--/.modal-input-penduduk-baru -->

  <?php include 'index_script.php' ?>
  <?php include_once 'helpers/sweetalert2_notify.php' ?>

  <!-- PAGE SCRIPT -->
  <script>
    $(document).ready(function() {

      const selectModalInputPendudukBaru = $('#ModalInputPendudukBaru .select2');

      initSelect2(selectModalInputPendudukBaru, {
        width: '100%',
        dropdownParent: "#ModalInputPendudukBaru .modal-content .modal-body"
      });

      // Re-init all feather icons
      feather.replace();
    });
  </script>


  <!-- Script for helper function isNikExists -->
  <script>
    const isNikExists = function(nik, callback) {
      $.ajax({
        url: 'get_penduduk_by_nik.php',
        method: 'POST',
        data: {
          nik: nik
        },
        dataType: 'JSON',
        success: function(data) {
          callback(data.length ? true : false);
        },
        error: function(request, status, error) {
          console.log("ajax call went wrong:" + request.responseText);
          // console.log("ajax call went wrong:" + error);
        }
      })
    }
  </script>


  <!-- Script for input pengajuan baru -->
  <script>
    $(document).ready(function() {

      $('.toggle_modal_tambah_dokumen_ktp').on('click', function() {
        $('#ModalInputPengajuanBaru .modal-title').html(`<i data-feather="plus-circle" class="me-2 mb-1"></i>Pengajuan Baru`);
        $('#ModalInputPengajuanBaru form').attr({action: 'dokumen_ktp_tambah.php', method: 'post'});
        
        // Re-init all feather icons
        feather.replace();
      
        $('#ModalInputPengajuanBaru').modal('show');
      });
      
      
      let debounceTimer;
      
      $('#xnik_pengajuan_baru').on('keyup', function() {
        const nik = $(this).val();
      
        clearTimeout(debounceTimer); // Clear the previous timeout
        debounceTimer = setTimeout(function() {
          isNikExists(nik, function(exist) {
            !exist
              ? $('#xnik_pengajuan_baru_help').removeClass('d-none')
              : $('#xnik_pengajuan_baru_help').addClass('d-none');
          });
        }, 500);
      });
      
      
      const formSubmitBtn = $('#ModalInputPengajuanBaru .toggle_swal_submit');
      const eventName = 'click';
      const formElement = $('#ModalInputPengajuanBaru form');
      const submitElement = $('<input />')
        .attr('type', 'hidden')
        .attr('name', 'xsubmit')
        .attr('value', 'Pengajuan Baru');

      toggleSwalSubmit(formSubmitBtn, eventName, formElement, submitElement);
      
    });
  </script>


  <!-- Script for input penduduk baru -->
  <script>
    $(document).ready(function() {

      $('.toggle_modal_tambah_penduduk').on('click', function() {
        $('#ModalInputPendudukBaru .modal-title').html(`<i data-feather="plus-circle" class="me-2 mb-1"></i>Penduduk Baru`);
        $('#ModalInputPendudukBaru form').attr({action: 'penduduk_tambah.php', method: 'post'});
        
        // Re-init all feather icons
        feather.replace();
      
        $('#ModalInputPendudukBaru').modal('show');
      });
      
      
      let debounceTimer;
      
      $('#xnik_penduduk_baru').on('keyup', function() {
        const nik = $(this).val();
      
        clearTimeout(debounceTimer); // Clear the previous timeout
        debounceTimer = setTimeout(function() {
          isNikExists(nik, function(exist) {
            !exist
              ? $('#xnik_penduduk_baru_help').addClass('d-none')
              : $('#xnik_penduduk_baru_help').removeClass('d-none');
          });
        }, 500);
      });
      
      
      const formSubmitBtn = $('#ModalInputPendudukBaru .toggle_swal_submit');
      const eventName = 'click';
      const formElement = $('#ModalInputPendudukBaru form');
      const submitElement = $('<input />')
        .attr('type', 'hidden')
        .attr('name', 'xsubmit')
        .attr('value', 'Tambah Penduduk Baru');

      toggleSwalSubmit(formSubmitBtn, eventName, formElement, submitElement);

    })
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
        $('#ModalCariByNik .modal-title').html(`<i data-feather="info" class="me-2 mb-1"></i>Cari Pengajuan Dokumen KTP`);
        
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
          url: 'get_dokumen_ktp_by_nik.php',
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

  
  <!-- Script for inner page Dokumen KTP Datatables with child row -->
  <script>
    // Formatting function for row details - modify as you need
    function format(d) {
      const status_validasi_html = d.status_validasi === 'sudah_divalidasi'
        ? `<span class="text-success">Sudah Divalidasi</span>`
        : `<span class="text-danger">Belum Divalidasi</span>`;

      let keterangan_pengajuan = d.keterangan_pengajuan !== ''
        ? d.keterangan_pengajuan
        : '<span class="text-muted">(Belum diisi)</span>';

      keterangan_pengajuan = keterangan_pengajuan ?? '<span class="text-muted">(Belum ada pengajuan)</span>';
      
      // `d` is the original data object for the row
      return (
        '<dl>' +
        '<dt>Status Validasi Data Penduduk:</dt>' +
        '<dd>' +
        status_validasi_html +
        '</dd>' +
        '<dt>Keterangan Validasi Data Penduduk:</dt>' +
        '<dd>' +
        d.keterangan_validasi +
        '</dd>' +
        '<dt>Email:</dt>' +
        '<dd>' +
        d.email +
        '</dd>' +
        '<dt>Alamat:</dt>' +
        '<dd>' +
        d.alamat +
        '</dd>' +
        '<dt>Keterangan Pengajuan:</dt>' +
        '<dd>' +
        keterangan_pengajuan +
        '</dd>' +
        '</dl>'
      );
    }
      
    let table = new DataTable('#tabel_dokumen_ktp', {  
      ajax: `<?= base_url_return('get_all_dokumen_ktp.php') ?>`,
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
          className: 'text-start',
          render: function(data, type, row, meta) {
            return meta.row + 1; // Return the row number starting from 1
          }
        }, // Incremental number
        { data: 'nama_lengkap' },
        { data: 'warga_negara' },
        { data: 'pekerjaan' },
        {
          data: null,
          render: function( data, type, row ) {
            if (!data.status_pengajuan) {
              return '<small class="text-muted">Belum ada pengajuan</small>';
            }
            
            return data.status_pengajuan === 'sudah_diproses'
              ? `<span class="text-success">Sudah Diproses</span>`
              : `<span class="text-danger">Belum Diproses</span>`;
          }
        },
        {
          data: null,
          render: function( data, type, row ) {
            return data.tgl_pengajuan ?? '<small class="text-muted">Belum ada pengajuan</small>';
          }
        },
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