<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Edit Kategori</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">

            <!-- Vertical Form -->
            <form method="POST" action="<?= base_url('kategori/edit/' . $kategori["id_kategori"]) ?>" class="row g-3" enctype="multipart/form-data">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama Kategori</label>
                    <input type="text" name="namakategori" class="form-control" id="kategori" value="<?= $kategori["nama_kategori"] ?>">
                    <?= form_error('kategori', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Foto Kategori</label>
                    <input type="file" name="fotokategori" class="form-control" id="fotokategori" required>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</main><!-- End #main -->