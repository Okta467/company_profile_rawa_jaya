<!DOCTYPE html>
<html lang="en">

<head>
  <?php session_start() ?>
  <?php include 'config/config.php' ?>
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
          <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
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
              <h4><a href="">Surat Domisili</a></h4>
              <p>Masyarakat mengisi data untuk pembuatan surat domisili.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Surat Keramaian</a></h4>
              <p>Masyarakat mengisi data untuk pembuatan surat keramaian.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-id-card"></i></div>
              <h4><a href="">KTP</a></h4>
              <p>Pembuatan Kartu Tanda Penduduk masyarakat dengan mengisi data diri.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-group"></i></div>
              <h4><a href="">KK</a></h4>
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
              <h4><a href="#sosial">Pengajuan</a></h4>
              <p>Masyarakat mengisi data diri untuk melakukan pengajuan bansos. Penerima manfaat yaitu yang layak sesuai dengan persyaratan yang berlaku.</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-wallet"></i></div>
              <h4><a href="#sosial">PKH</a></h4>
              <p>Bantuan sosial bersyarat kepada Keluarga Miskin (KM) yang ditetapkan sebagai penerima manfaat Program Kartu Harapan (PKH).</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-wallet"></i></div>
              <h4><a href="#sosial">BLT</a></h4>
              <p>Bantuan Langsung Tunai untuk melindungi daya beli masyarakat prasejahtera akibat tekanan berbagai kenaikan harga secara global.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-book-reader"></i></div>
              <h4><a href="#sosial">Pendidikan</a></h4>
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
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Proyek</th>
                <th>Tujuan</th>
                <th>Manfaat</th>
                <th>Tahapan</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 ?>
              <?php while ($i <= 10) : ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td>Jalan X</td>
                  <td>Tujuan abcdefg</td>
                  <td>1) Manfaat pertama; 2) Manfaat kedua; n) ...</td>
                  <td>1) Tahap pertama; 2) Tahap kedua; n) ...</td>
                  <td>Lihat Detail</td>
                </tr>
              <?php endwhile ?>
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

</body>

</html>