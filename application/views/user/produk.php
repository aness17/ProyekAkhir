<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header">
        <h2>Produk</h2>
    </div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5">

                <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item">

                        <?php $no = 1;
                        // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                        foreach ($produk as $produks) : ?>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                                <img class="img-fluid" src="<?= base_url('produk/') . $produks['foto_produk'] ?>" alt="">

                                <a href="#" class="stretched-link">
                                    <h3><?= $produks['nama_produk'] ?></h3>
                                </a>
                                <h3>Rp<?= $produks['harga_produk'] ?></h3>
                            </div>
                        <?php $no++;
                        endforeach; ?>
                    </div>
                </div><!-- End Service Item -->
            </div>
        </div>
    </section>
</main>