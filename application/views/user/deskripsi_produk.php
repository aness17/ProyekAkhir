<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header" style="padding-bottom: 0;">
        <div class="d-flex justify-content-evenly">
            <h2 style="font-family: monospace;">Deskripsi Produk</h2>

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
                                <form action="<?= base_url('auth/tambah_keranjang') ?>" method="post">
                                    <div class="mb-3">
                                        <input type="hidden" name="id" value="<?= $detail["id_produk"] ?>">
                                        <label for="recipient-name" class="col-form-label">Jumlah:</label>
                                        <input type="number" name="jumlah" min="1" value="1" class="form-control">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Tambah Keranjang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- End Service Item -->
            </div>
        </div>
    </section>
</main>