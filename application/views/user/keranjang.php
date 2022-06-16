<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header">
        <div class="d-flex justify-content-evenly">
            <h2>Keranjang</h2>

        </div>
    </div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5">

                <div class="col-xl-8 col-md-12" data-aos="zoom-in" data-aos-delay="200">

                    <?php foreach ($keranjang as $keranjangs) : ?>
                        <div class="service-item mb-4">
                            <div class="row">
                                <div class="col"><img src="<?= base_url('produk/') . $keranjangs['foto_produk'] ?>" alt="" class="img-fluid" style="height:200px; object-fit:cover; object-position:center;"></div>
                                <div class="col">
                                    <h3><?= $keranjangs['nama_produk'] ?></h3>
                                    <h3>Rp<?= $keranjangs['harga_produk'] ?></h3>
                                    <form action="<?= base_url('auth/ubah_keranjang') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $keranjangs["id_keranjang"] ?>">
                                        <input type="number" name="jumlah" min="0" value="<?= $keranjangs['ket_jumlah'] ?>" class="form-control my-3">
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ubah Keranjang</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!-- End Service Item -->
            </div>
            <?php if (count($keranjang) > 0) : ?>
                <div class="row">
                    <div class="col">
                        <a href="<?= base_url('auth/checkout') ?>" class="btn btn-primary">Checkout</a>
                    </div>
                </div>

            <?php else : ?>
                <h1 class="text-center">Tidak ada barang di keranjang</h1>
            <?php endif; ?>
        </div>
    </section>
</main>