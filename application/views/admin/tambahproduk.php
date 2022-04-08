<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Tambah Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Vertical Form</h5>

            <!-- Vertical Form -->
            <form method="POST" action="<?= base_url('admin/addproduk') ?>" class="row g-3">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Keterangan Produk</label>
                    <input type="text" class="form-control" id="inputEmail4">
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Harga Produk</label>
                    <input type="text" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Stok Produk</label>
                    <input type="number" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Foto Produk</label>
                    <input type="text" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Kategori Produk</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">UMKM</label>
                    <input type="text" class="form-control" id="inputPassword4">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</main><!-- End #main -->