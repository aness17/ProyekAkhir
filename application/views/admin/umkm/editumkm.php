<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Edit UMKM</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">

            <!-- Vertical Form -->
            <form method="POST" action="<?= base_url('umkm/edit/' . $umkm["id_umkm"]) ?>" class="row g-3" enctype="multipart/form-data">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama UMKM</label>
                    <input type="text" name="namaumkm" class="form-control" id="namaumkm" value="<?= $umkm["nama_umkm"] ?>">
                    <?= form_error('namaumkm', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Alamat UMKM</label>
                    <input type="text" name="alamatumkm" class="form-control" id="alamatumkm" value="<?= $umkm["alamat_umkm"] ?>">
                    <?= form_error('alamatumkm', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">No. Telp UMKM</label>
                    <input type="text" name="notelpumkm" class="form-control" id="notelpumkm" value="<?= $umkm["notelp_umkm"] ?>">
                    <?= form_error('notelpumkm', '<small class="form-text text-danger">', '</small>'); ?>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</main><!-- End #main -->