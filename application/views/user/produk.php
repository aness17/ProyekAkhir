<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header">
        <div class="d-flex justify-content-evenly">
            <div></div>
            <h2 style="font-family: cursive;">Produk</h2>
            <?php if ($this->session->userdata('id_role') == 3) : ?>
                <a href="<?= base_url('auth/keranjang') ?>">
                    <i class="bi bi-basket-fill text-dark" style="font-size: 32px;"></i>
                </a>
            <?php else : ?>
                <div></div>
            <?php endif; ?>
        </div>
    </div>
    <section id="features" class="features" style="padding: 10px 0 !important;">
        <div class="container" data-aos="fade-up">
            <ul class="nav nav-tabs row gy-4 d-flex">
                <?php
                $kategori = $this->db->query("SELECT * FROM kategori order by nama_kategori ASC");
                foreach ($kategori->result_array() as $kategoris) : ?>
                    <li class="nav-item col-6 col-md-4 col-lg-2">
                        <a class="nav-link" href="<?= base_url('auth/produk/' . $kategoris['nama_kategori']) ?>"><?= $kategoris['nama_kategori'] ?></a>

                    </li><!-- End Tab 1 Nav -->

                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <section id="features" class="features" style="padding: 10px 0 !important;">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <form action="" method="post">
                <div class="row flex-row align-items-end" id="form-tanggal">
                    <div class="col-lg-3">
                        <h5 class="card-title">Min. Harga</h5>
                        <input type="number" value="0" min="0" name="harga" id="harga" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <h5 class="card-title">Max. Harga</h5>
                        <input type="number" value="0" min="0" name="harga2" id="harga2" class="form-control">
                    </div>
                    <div class="col">
                        <button type="submit" id="tombol" class="btn btn-primary">Terapkan</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5 mb-5">
                <?php $no = 1;
                // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                foreach ($produk as $produks) : ?>
                    <div class="col-xl-3 col-md-s6 " data-aos="zoom-in" data-aos-delay="200">
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
                <?php $no++;
                endforeach; ?>
            </div>
        </div>
    </section>
</main>