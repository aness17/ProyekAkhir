<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header" style="padding-bottom: 0;">
        <div class="d-flex justify-content-evenly">
            <div></div>
            <h2 style="font-family: monospace;">Profil</h2>
            <?php
            // foreach ($pelanggan as $p) :

            if ($this->session->userdata('id_role') == 3) : ?>
                <a href="<?= base_url('auth/edit_profil/' . $pelanggan['id_pelanggan']) ?>">
                    <i class="bi bi-pencil-square" style="font-size: 32px;"></i>
                </a>
            <?php else : ?>
                <div></div>
            <?php endif; ?>
        </div>
    </div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center gy-5">
                <div class="col-xl-8 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item">
                        <div class="row align-items-center">
                            <div class="col"><img src="<?= base_url('assets/') ?>pelanggan/assets/img/profil.jpg" alt="" style="width:300px"></div>
                            <div class="col">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Nama</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                <?= $pelanggan['nama_pelanggan'] ?> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Username</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                <?= $pelanggan['username_pelanggan'] ?> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Alamat</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                <?= $pelanggan['alamat_pelanggan'] ?> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">No. Hp</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                <?= $pelanggan['nohp_pelanggan'] ?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col">
                                <h3>Nama : </h3>
                                <h3>Username : <?= $pelanggan['username_pelanggan'] ?></h3>
                                <h3>Alamat : <?= $pelanggan['alamat_pelanggan'] ?></h3>
                                <h3>No hp:<?= $pelanggan['nohp_pelanggan'] ?></h3>

                                <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Keranjang</button> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div><!-- End Service Item -->
            </div>
        </div>
    </section>
</main>