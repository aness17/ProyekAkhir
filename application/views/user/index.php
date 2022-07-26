<section id="hero-animated" class="hero-animated d-flex align-items-center">
  <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
    </br><img src="<?= base_url('assets/') ?>admin/assets/img/logo.png" alt="" width="300px" class="img-fluid animated">
  </div>
</section>

<main id="main">

  <section id="features" class="features">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <h2 style="font-family: monospace;">Produk Terlaris</h2>
        <div class="row gy-4 d-flex mt-4">
          <?php foreach ($bestSeller as $produks) : ?>
            <div class="col-xl-4" data-aos="zoom-in" data-aos-delay="200">
              <div class="service-item mb-3">
                <div class="details position-relative" style="margin: -20px 30px!important;">

                  <img class="img-fluid" src="<?= base_url('produk/') . $produks['foto_produk'] ?>" style="height: 200px; object-fit:cover; object-position:center;" alt="">

                  <a href="<?= base_url('auth/deskripsi_produk/') . $produks["id_produk"] ?>?search=false" class="stretched-link">
                    <h3 style="font-size:medium ;"><?= $produks['nama_produk'] ?></h3>
                  </a>
                  <h3 style="font-size:medium ;">Rp <?= number_format($produks['harga_produk'], 0, ",", "."); ?></h3>
                </div>
              </div>
            </div><!-- End Service Item -->
          <?php endforeach; ?>
        </div>
      </div>

    </div>

  </section>

  <!-- ======= On Focus Section ======= -->
  <section id="onfocus" class="onfocus">
    <div class="container-fluid p-0" data-aos="fade-up">

      <div class="row g-0">
        <div class="col-lg-12 video-play position-relative">
          <a href="https://www.youtube.com/watch?v=WMf_9772JmM" class="glightbox play-btn"></a>
        </div>
      </div>

    </div>
  </section><!-- End On Focus Section -->
  <section id="featured-services" class="featured-services">
    <div class="container">
      <div class="section-header">
        <h2 style="font-family: monospace;" class="">Berita Viera</h2>

      </div>

      <div class="row gy-4 ">
        <div class="col-xl-4 col-md-6 d-flex " data-aos="zoom-out" data-aos-delay="400">
          <div class="service-item position-relative">
            <img src="<?= base_url('assets/') ?>pelanggan/assets/img/juara.png" alt="" width="400px" class="img-fluid animated">
            <br />

            <h4 style="text-align: center ;font-family:serif ;font-size: medium;"><a href="<?= base_url('auth/juara2') ?>" class="stretched-link">Viera Oleh-oleh Raih Juara 2 Pada Anugerah Pesona Indonesia</a></h4>
          </div>
        </div><!-- End Service Item -->
        <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out">
          <div class="service-item position-relative">
            <img src="<?= base_url('assets/') ?>pelanggan/assets/img/MOU.png" alt="" width="400px" class="img-fluid animated">
            <br />
            <h4 style="text-align: center ; font-family:serif ; font-size: medium;"><a href="<?= base_url('auth/dinaspariwisata') ?>" class="stretched-link">Viera Oleh-oleh Bekerjasama dengan Dinas Pariwisata dan Kebudayaan Kota Pekanbaru</a></h4>
          </div>
        </div><!-- End Service Item -->
        <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out">
          <div class="service-item position-relative">
            <img src="<?= base_url('assets/') ?>pelanggan/assets/img/muri.png" alt="" width="400px" class="img-fluid animated">
            <br />
            <h4 style="text-align: center ;font-family:serif ;font-size: medium;"><a href="<?= base_url('auth/muri') ?>" class="stretched-link">Viera Oleh-oleh Raih Rekor Muri Ketan Talam Durian Terpanjang</a></h4>
          </div>
        </div><!-- End Service Item -->

      </div>

    </div>
  </section><!-- End Featured Services Section -->



  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">

      <div class="testimonials-slider swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="testimonial-item">
              <img src="" class="testimonial-img" alt="">
              <h3>Micelli zhalmhariawan</h3>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                aku paling langganan dari dulu di viera,
                pas suami pulang ke medan oleh-olehnya selalu dari viera sampe
                tinggal di pekanbaru juga sering jajan di viera yang gerai panam, sekarang
                udahh jauh di lombok, janji deh pulang ke pku bakal borong
                talam durian di sini. solah betol la oleh-oleh di viera nii.
                semuanya enak-enak <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
              <h3>Nopita Saputri</h3>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                Seneng banget liat rumah kue Viera sekarang,
                yg.dulunya cuman buka 1 ruko, sekarang bisa buka dimana
                mana, sukses terus RKV <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
              <h3>Intan Fadillah</h3>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                Langganan tempat jajan tersayang, enak kenyang dan selalu puas dengan rasanya <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
              <h3>Riky Aditya</h3>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                Mantap, top markotop. apa saja jenis kue yang aku pesan tidak mengecewakan.. rasanya wuenak tenan <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
              <h3>Desri Elfiani</h3>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                Aku sering belanja disini, soalnya pelayanannya ramah banget dan juga kue yang ada semuanya enak-enak
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Testimonials Section -->

</main><!-- End #main -->