<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Tambah UMKM</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">

            <!-- Vertical Form -->
            <form method="POST" action="<?= base_url('umkm/addumkm') ?>" class="row g-3" enctype="multipart/form-data">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama UMKM</label>
                    <input type="text" name="namaumkm" class="form-control" id="namaumkm">
                    <?= form_error('namaumkm', '<small class="form-text text-danger">', '</small>'); ?>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</main><!-- End #main -->