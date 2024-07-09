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
  <?php include 'index_header.php' ?>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1><?= SITE_NAME ?></h1>
          <h2>Memudahkan masyarakat dalam mengakses layanan administrasi, sosial, dan infrastruktur desa.</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#administrasi" class="btn-get-started scrollto">Get Started</a>
            <a href="#hero" class="btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="<?= base_url('assets/landing_page/img/hero-img.png') ?>" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Administrasi Section ======= -->
    <section id="administrasi" class="services section-bg">
      <div class="container" data-aos="fade-up" data-aos-duration="500">

        <div class="section-title">
          <h2>Administrasi</h2>
          <p>Masyarakat dapat menggunakan layanan administrasi untuk pembuatan surat domisili dan keramaian serta dapat mengajukan pembuatan Kartu Tanda Penduduk (KTP) dan Kartu Keluarga (KK) dengan mengisi data diri pribadi.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="surat_domisili.php">Surat Domisili</a></h4>
              <p>Masyarakat mengisi data untuk pembuatan surat domisili.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="surat_keramaian.php">Surat Keramaian</a></h4>
              <p>Masyarakat mengisi data untuk pembuatan surat keramaian.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-id-card"></i></div>
              <h4><a href="dokumen_ktp.php">KTP</a></h4>
              <p>Pembuatan Kartu Tanda Penduduk masyarakat dengan mengisi data diri.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-group"></i></div>
              <h4><a href="dokumen_kk.php">KK</a></h4>
              <p>Pembuatan Kartu Keluarga dengan mengisi data anggota keluarga.</p>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Administrasi Section -->

    <!-- ======= Sosial Section ======= -->
    <section id="sosial" class="services section-bg">
      <div class="container" data-aos="fade-up" data-aos-duration="500">

        <div class="section-title">
          <h2>Sosial</h2>
          <p>Masyarakat dapat mengajukan data diri untuk diberikan bantuan sosial atau melihat daftar layanan informasi seperti: Program Keluarga Harapan (PKH), Bantuan Langsung Tunai (BLT), serta bantuan pendidikan.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="bantuan_sosial_pengajuan.php">Pengajuan</a></h4>
              <p>Masyarakat mengisi data diri untuk melakukan pengajuan bansos. Penerima manfaat yaitu yang layak sesuai dengan persyaratan yang berlaku.</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-wallet"></i></div>
              <h4><a href="bantuan_sosial_pkh.php">PKH</a></h4>
              <p>Bantuan sosial bersyarat kepada Keluarga Miskin (KM) yang ditetapkan sebagai penerima manfaat Program Kartu Harapan (PKH).</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-wallet"></i></div>
              <h4><a href="bantuan_sosial_blt.php">BLT</a></h4>
              <p>Bantuan Langsung Tunai untuk melindungi daya beli masyarakat prasejahtera akibat tekanan berbagai kenaikan harga secara global.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-book-reader"></i></div>
              <h4><a href="bantuan_sosial_pendidikan.php">Pendidikan</a></h4>
              <p>Bantuan pendidikan berupa alat tulis, peralatan olahraga seperti bola voli, bola kaki, bola sepak takraw, dan seragam olahraga.</p>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Sosial Section -->

    <!-- ======= Infrastruktur Section ======= -->
    <section id="infrastruktur" class="services section-bg">
      <div class="container" data-aos="fade-up" data-aos-duration="500">

        <div class="section-title">
          <h2>Infrastruktur</h2>
          <p>Berisi informasi proyek atau pembangunan fasilitas umum yang akan dan/atau sedang dikerjakan seperti: jalan, parit, gedung serba guna, dan lain-lain. Informasi pembangunan ini mencakup detail, tujuan, tahapan, serta manfaatnya.</p>
        </div>

        <div class="row">
          <table class="table table-striped table-hover table-responsive datatables" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Proyek</th>
                <th>Tujuan</th>
                <th>Manfaat</th>
                <th>Tahapan</th>
                <th>Detail</th>
                <th>Status</th>
                <th>Tgl. Proyek</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query_proyek = mysqli_query($connection, "SELECT * FROM tbl_proyek ORDER BY id DESC");

              while ($proyek = mysqli_fetch_assoc($query_proyek)):
                $status_proyek = $proyek['status_proyek'];
                $formatted_status_proyek = ucwords(str_replace('_', ' ', $status_proyek));
              ?>

                <tr>
                  <td scope="row"><?= $no++ ?></td>
                  <td><?= $proyek['nama_proyek'] ?></td>
                  <td>
                    <div class="ellipsis toggle_tooltip" title="<?= $proyek['tujuan'] ?>">
                      <?= $proyek['tujuan'] ?>
                    </div>
                  </td>
                  <td>
                    <div class="ellipsis toggle_tooltip" title="<?= $proyek['manfaat'] ?>">
                      <?= $proyek['manfaat'] ?>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary toggle_modal_detail"
                      data-tahapan="<?= htmlspecialchars($proyek['tahapan']) ?>">
                      <i class="bi bi-list-ul me-1"></i>
                      Tahapan
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm rounded-pill btn-outline-primary toggle_modal_detail"
                      data-detail="<?= htmlspecialchars($proyek['detail']) ?>">
                      <i class="bi bi-list-ul me-1"></i>
                      Detail
                    </button>
                  </td>
                  <td>
                    <?php if ($status_proyek === 'akan_dikerjakan'): ?>
                      
                      <small class="text-danger"><?= $formatted_status_proyek ?></small>
                      
                    <?php elseif ($status_proyek === 'sedang_dikerjakan'): ?>
                    
                      <small class="text-primary"><?= $formatted_status_proyek ?></small>
                      
                    <?php elseif ($status_proyek === 'selesai'): ?>
                    
                      <small class="text-success"><?= $formatted_status_proyek ?></small>

                    <?php endif ?>
                  </td>
                  <td><?= $proyek['tgl_proyek'] ?></td>
                </tr>
              
              <?php endwhile ?>
              <?php mysqli_close($connection) ?>
            </tbody>
          </table>
        </div>

      </div>
    </section>
    <!-- End Infrastruktur Section -->

    <!-- ======= Kontak Section ======= -->
    <section id="kontak" class="contact">
      <div class="container" data-aos="fade-up" data-aos-duration="500">

        <div class="section-title">
          <h2>Kontak</h2>
          <p>Masyarakat dapat memberikan aspirasi seperti saran serta masukan kepada pemerintah Desa Rawa Jaya sebagai bentuk kontribusi masyarakat dalam memajukan desa.</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Alamat:</h4>
                <p>Jln. Raya Desa Rawa Jaya, Kec. Pemulutan, Ogan Ilir, SUMSEL</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>RawaJaya@examplemail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telepon:</h4>
                <p>+62 xx xxxx xxxx</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31870.513480893227!2d104.75911938802564!3d-3.143697724337547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b9a7d8525860b%3A0x864ae0ba66d272cb!2sRawa%20Jaya%2C%20Pemulutan%2C%20Ogan%20Ilir%20Regency%2C%20South%20Sumatra!5e0!3m2!1sen!2sid!4v1720238668662!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="saran_dan_masukan_tambah.php" method="post" role="form" class="php-email-form" id="saran_dan_masukan_form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="xnama_lengkap">Nama Lengkap</label>
                  <input type="text" name="xnama_lengkap" class="form-control" id="xnama_lengkap" autocomplete="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="xemail">Email</label>
                  <input type="email" class="form-control" name="xemail" id="xemail" autocomplete="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="xperihal">Perihal</label>
                <input type="text" class="form-control" name="xperihal" id="xperihal" required>
              </div>
              <div class="form-group">
                <label for="xpesan">Pesan (Saran dan Masukan)</label>
                <textarea class="form-control" id="xpesan" name="xpesan" rows="10" autocomplete="off" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Memuat</div>
                <div class="error-message"></div>
                <div class="sent-message">Pesan terkirim, terima kasih!</div>
              </div>
              <div class="text-center"><button name="xsubmit" type="submit">Kirim Pesan</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>
    <!-- End Kontak Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'index_footer.php' ?>
  <!-- End Footer -->

  <div id="preloader"></div> <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!--============================= MODAL PESAN DETAIL =============================-->
  <!-- * * Note: * * This modal also can be used for tahapan-->
  <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="ModalDetail" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i data-feather="info" class="me-2"></i>Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <div class="px-3 py-1" id="detail_proyek"></div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-light border" type="button" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!--/.modal-pesan-detail -->

  <?php include 'index_script.php' ?>
  <?php include_once 'helpers/sweetalert2_notify.php' ?>

  <!-- PAGE SCRIPT -->
  <script>
    let formSaranDanMasukan = document.getElementById('saran_dan_masukan_form');

    formSaranDanMasukan.addEventListener('submit', function(e) {
      e.preventDefault();

      const form = e.target;
      const thisForm = this;
      const formData = new FormData(form);

      thisForm.querySelector('.loading').classList.add('d-block');

      formData.set('xsubmit', true);
      
      fetch(form.action, {
        method: form.method,
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        console.log(data);

        thisForm.querySelector('.loading').classList.remove('d-block');
        
        if (data) {
          thisForm.querySelector('.sent-message').classList.add('d-block');
          thisForm.reset();
        } else {
          throw new Error('Terjadi kesalahan saat mengirim pesan.'); 
        }
      })
      .catch(error => {
        console.error("ajax call went wrong:", error);

        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.querySelector('.error-message').innerHTML = error;
        thisForm.querySelector('.error-message').classList.add('d-block');
      });

      setTimeout((e) => {
        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.querySelector('.sent-message').classList.remove('d-block');
        thisForm.querySelector('.error-message').classList.remove('d-block');
      }, 5000);
    })
  </script>

  <script>
    $(document).ready(function() {
      // Datatables initialise
      $('.datatables').DataTable({
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

      
      $('.datatables').on('click', '.toggle_modal_detail', function() {
        const tahapan = $(this).data('tahapan');
        const detail = $(this).data('detail');
        const modal_title = tahapan ? 'Tahapan Proyek' : 'Detail Proyek';
      
        const html_text = tahapan ?? detail;
      
        const sanitized_html_text = DOMPurify.sanitize(html_text, { USE_PROFILES: { html: true } });
        const parsed_html_text = marked.parse(sanitized_html_text);
      
        $('#ModalDetail #detail_proyek').html(parsed_html_text);
      
        $('#ModalDetail .modal-title').html(`<i data-feather="info" class="me-2"></i>${modal_title}`);
        
        // Re-init all feather icons
        feather.replace();
      
        $('#ModalDetail').modal('show');
      });
    });  
  </script>

</body>

</html>