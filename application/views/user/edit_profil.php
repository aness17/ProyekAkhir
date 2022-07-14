<section id="hero-animated" class="">

</section>
<main id="main">
    <section id="services" class="services" style="padding-bottom: 0;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center gy-5">
                <div class="col-xl-8 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Edit Profil</h5>
                            </div>

                            <form method="POST" action="<?= base_url('auth/edit_profil/' . $pelanggan['id_pelanggan']) ?>" class="row g-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <label for="Nama" class="form-label">Nama Pelanggan</label>
                                    <input type="text" name="nama" class="form-control" id="yourName" value="<?= $pelanggan["nama_pelanggan"] ?>" required>
                                    <?= form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>

                                <div class="col-12">
                                    <label for="Username" class="form-label">Username Pelanggan</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="username" class="form-control" id="yourUsername" value="<?= $pelanggan["username_pelanggan"] ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="Alamat" class="form-label">Alamat Pelanggan</label>
                                    <input type="text" name="alamat" class="form-control" id="yourPassword" value="<?= $pelanggan["alamat_pelanggan"] ?>" required>
                                    <?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="col-12">
                                    <label for="nohp" class="form-label">No. Hp</label>
                                    <input type="text" name="nohp" class="form-control" id="yourPassword" value="<?= $pelanggan["nohp_pelanggan"] ?>" required>
                                    <?= form_error('nohp', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Perbaharui Profil</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div><!-- End Service Item -->
            </div>

        </div>
    </section>
</main>