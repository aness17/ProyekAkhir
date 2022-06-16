<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header">
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
                            <div class="col"><img src="<?= base_url('produk/') . $produk['foto_produk'] ?>" alt="" style="width:400px"></div>
                            <div class=" col">
                                <h3><?= $produk['nama_produk'] ?></h3>
                                <h3><?= $produk['keterangan_produk'] ?></h3>
                                <h3>Rp<?= $produk['harga_produk'] ?></h3>
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Keranjang</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Service Item -->
            </div>
        </div>
    </section>
</main>
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $produk['nama_produk'] ?> ke Keranjang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('auth/tambah_keranjang') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $produk["id_produk"] ?>">
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