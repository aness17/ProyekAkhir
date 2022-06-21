<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header">
        <div class="d-flex justify-content-evenly">
            <div></div>
            <h2>Produk</h2>
            <?php if ($this->session->userdata('id_role') == 3) : ?>
                <a href="<?= base_url('auth/keranjang') ?>">
                    <i class="bi bi-basket-fill text-dark" style="font-size: 32px;"></i>
                </a>
            <?php else : ?>
                <div></div>
            <?php endif; ?>
        </div>
    </div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5">
                <?php $no = 1;
                // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                foreach ($produk as $produks) : ?>
                    <div class="col-xl-3 col-md-s6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item">
                            <div class="details position-relative">

                                <img class="img-fluid" src="<?= base_url('produk/') . $produks['foto_produk'] ?>" style="height: 200px; object-fit:cover; object-position:center;" alt="">

                                <a href="<?= base_url('auth/deskripsi_produk/') . $produks["id_produk"] ?>" class="stretched-link">
                                    <h3 style="font-size:medium ;"><?= $produks['nama_produk'] ?></h3>
                                </a>
                                <h3 style="font-size:medium ;">Rp<?= $produks['harga_produk'] ?></h3>
                            </div>
                        </div>
                    </div><!-- End Service Item -->
                <?php $no++;
                endforeach; ?>
            </div>
        </div>
    </section>
</main>