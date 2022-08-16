<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header">
        <div class="d-flex justify-content-evenly">
            <div></div>
            <h2 style="font-family: monospace;">Kategori Produk</h2>
            <?php if ($this->session->userdata('id_role') == 3) : ?>
                <a href="<?= base_url('auth/keranjang') ?>">
                    <i class="bi bi-basket-fill text-dark" style="font-size: 32px;"></i>
                    <span class="badge bg-primary badge-number"><?= $jumlahkeranjang ?></span>
                </a>
            <?php else : ?>
                <div></div>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <br>
    <section id="services" class="services" style="padding: 10px 0 !important;">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5 mb-5">
                <?php
                $kategori = $this->db->query("SELECT * FROM kategori order by nama_kategori ASC");
                foreach ($kategori->result_array() as $kategoris) : ?>
                    <div class="col-xl-3 col-md-s6 " data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item mb-3">
                            <div class="details position-relative" style="margin: -20px 30px!important;">

                                <img class="img-fluid" src="<?= base_url('kategori/') . $kategoris['foto_kategori'] ?>" style="height: 200px; object-fit:cover; object-position:center;" alt="">

                                <a href="<?= base_url('auth/produk/' . $kategoris['nama_kategori']) ?>" class="stretched-link">
                                    <h3 style="font-size:larger ;"><?= $kategoris['nama_kategori'] ?></h3>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                <?php
                endforeach; ?>
            </div>
        </div>
    </section>
</main>