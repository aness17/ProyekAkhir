<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header" style="padding-bottom: 0;">
        <div class="d-flex justify-content-evenly">
            <h2>Keranjang</h2>

        </div>
    </div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5">
                <div class="col-xl-12 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                    <?php foreach ($keranjang as $keranjangs) : ?>
                        <div class="service-item mb-4">
                            <div class="row">
                                <div class="col"><img src="<?= base_url('produk/') . $keranjangs['foto_produk'] ?>" alt="" class="img-fluid" style="height:200px; object-fit:cover; object-position:center;"></div>
                                <div class="col">
                                    <h3><?= $keranjangs['nama_produk'] ?></h3>
                                    <h3>Rp<?= number_format($keranjangs['harga_produk'], 0, ",", "."); ?></h3>
                                    <form action="<?= base_url('auth/ubah_keranjang') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $keranjangs["id_keranjang"] ?>">
                                        <input type="number" name="jumlah" min="0" value="<?= $keranjangs['ket_jumlah'] ?>" class="form-control my-3">
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ubah Keranjang</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <div class="container" data-aos="fade-up">
                                        <h3 class="mb-3">Rekomendasi Produk</h3>
                                        <?php if (count($keranjangs['rekomendasi']) > 0) : ?>
                                            <?php foreach ($keranjangs['rekomendasi'] as $produks) : ?>
                                                <div class="row justify-content-center gy-5">
                                                    <div class="col-xl-12 col-md-12 " data-aos="zoom-in" data-aos-delay="200">
                                                        <a href="<?= base_url('auth/deskripsi_produk/') . $produks["id_produk"] ?>?search=false" class="stretched-link">
                                                            <h3 style="font-size:medium ;"><?= $produks['nama_produk'] ?></h3>
                                                        </a>
                                                    </div><!-- End Service Item -->
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <h3 style="font-size:medium ;">Tidak Ada Rekomendasi</h3>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!-- End Service Item -->
            </div>
            <hr>
            <?php if (count($keranjang) > 0) : ?>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <?php $total = 0;
                    $total_harga = 0;
                    foreach ($keranjang as $k) {
                        $total += intval($k["ket_jumlah"]);
                        $total_harga += intval($k["ket_jumlah"] * $k['harga_produk']);
                    }
                    ?>
                    <div class="col-sm-4 ">
                        <h3>Total (<?= $total ?> produk) : Rp<?= number_format($total_harga, 0, ",", "."); ?></h3>
                    </div>
                    <div class="col-sm-4">
                        <a style="align-items: flex-end;width: 300px;" href="<?= base_url('auth/checkout') ?>" class="btn btn-success btn-lg">Checkout</a>
                    </div>
                </div>
            <?php else : ?>
                <h1 class="text-center">Tidak ada barang di keranjang</h1>
            <?php endif; ?>
        </div>

    </section>
</main>