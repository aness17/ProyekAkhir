<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header" style="padding-bottom: 0;">
        <div class="d-flex justify-content-evenly">
            <h2>Deskripsi Produk</h2>

        </div>
    </div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center gy-5">

                <div class="col-xl-8 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item">
                        <div class="row align-items-center">
                            <div class="col"><img src="<?= base_url('produk/') . $detail['foto_produk'] ?>" alt="" style="width:400px"></div>
                            <div class=" col">
                                <h3><?= $detail['nama_produk'] ?></h3>
                                <p><?= $detail['keterangan_produk'] ?></p>
                                <h3>Rp <?= number_format($detail['harga_produk'], 0, ",", "."); ?></h3>
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Keranjang</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Service Item -->
            </div>

        </div>
    </section>
    <?php if ($rekomendasi != null) : ?>
        <div class="section-header" style="padding-bottom: 0;">
            <div class="d-flex justify-content-evenly">
                <h2>Rekomendasi</h2>
            </div>
        </div>
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center gy-5">
                    <?php if (count($rekomendasi) > 0) : ?>
                        <?php foreach ($rekomendasi as $produks) : ?>
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
                        <?php endforeach; ?>
                    <?php else : ?>
                        <h1>Tidak Ada Rekomendasi</h1>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    <?php endif ?>
</main>
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $detail['nama_produk'] ?> ke Keranjang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('auth/tambah_keranjang') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $detail["id_produk"] ?>">
                    <label for="recipient-name" class="col-form-label">Jumlah:</label>
                    <input type="number" name="jumlah" min="1" value="1" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Keranjang</button>
                </div>
            </form>
        </div>
    </div>
</div>