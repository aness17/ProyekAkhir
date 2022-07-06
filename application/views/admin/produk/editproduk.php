<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Edit Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">

            <!-- Vertical Form -->
            <form method="POST" action="<?= base_url('produk/edit/' . $produk["id_produk"]) ?>" class="row g-3" enctype="multipart/form-data">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama Produk</label>
                    <input type="text" name="namaproduk" class="form-control" id="namaproduk" value="<?= $produk["nama_produk"] ?>">
                    <?= form_error('namaproduk', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Keterangan Produk</label>
                    <input type="text" name="keteranganproduk" class="form-control" id="keteranganproduk" value="<?= $produk["keterangan_produk"] ?>">
                    <?= form_error('keteranganproduk', '<small class="form-text text-danger">', '</small>'); ?>

                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Harga Produk</label>
                    <input type="text" name="hargaproduk" class="form-control" id="hargaproduk" value="<?= $produk["harga_produk"] ?>">
                    <?= form_error('hargaproduk', '<small class="form-text text-danger">', '</small>'); ?>

                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Stok Produk</label>
                    <input type="number" name="stokproduk" class="form-control" id="stokproduk" min="0" value="<?= $produk["stok_produk"] ?>">
                    <?= form_error('stokproduk', '<small class="form-text text-danger">', '</small>'); ?>

                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Foto Produk</label>
                    <input type="file" name="fotoproduk" class="form-control" id="fotoproduk">

                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Kategori Produk</label>
                    <select name="kategori" class="form-control" id="exampleFormControlSelect1" name="kategori">

                        <?php
                        $kategori = $this->db->query("SELECT * FROM kategori order by nama_kategori ASC");
                        foreach ($kategori->result_array() as $kategoris) : ?>
                            <option value="<?= $kategoris['id_kategori'] ?>" <?= ($produk["fk_kategori"] == $kategoris['id_kategori']) ? "selected" : "" ?>><?= $kategoris['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('kategori', '<small class="form-text text-danger">', '</small>'); ?>

                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">UMKM</label>
                    <select name="umkm" class="form-control" id="exampleFormControlSelect1" name="umkm">

                        <?php
                        $umkm = $this->db->query("SELECT * FROM umkm order by nama_umkm ASC");
                        foreach ($umkm->result_array() as $umkms) : ?>
                            <option value="<?= $umkms['id_umkm'] ?>" <?= ($produk["fk_umkm"] == $umkms['id_umkm']) ? "selected" : "" ?>><?= $umkms['nama_umkm'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('umkm', '<small class="form-text text-danger">', '</small>'); ?>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</main><!-- End #main -->