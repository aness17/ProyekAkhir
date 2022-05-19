<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Edit Pelanggan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">

            <!-- Vertical Form -->
            <form method="POST" action="<?= base_url('pelanggan/edit/' . $pelanggan["id_pelanggan"]) ?>" class="row g-3" enctype="multipart/form-data">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="namapelanggan" class="form-control" id="namapelanggan" value="<?= $pelanggan["nama_pelanggan"] ?>">
                    <?= form_error('namapelanggan', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Username</label>
                    <input type="text" readonly name="username" class="form-control" id="username" value="<?= $pelanggan["username_pelanggan"] ?>">
                    <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
                </div>

                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $pelanggan["alamat_pelanggan"] ?>">
                    <?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">No. Telp</label>
                    <input type="text" name="notelp" class="form-control" id="notelp" value="<?= $pelanggan["nohp_pelanggan"] ?>">
                    <?= form_error('notelp', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Role</label>
                    <select name="role" class="form-control" id="exampleFormControlSelect1" name="role" value="<?= $pelanggan["fk_role"] ?>">

                        <?php
                        $role = $this->db->query("SELECT * FROM roles");
                        foreach ($role->result_array() as $roles) : ?>
                            <option value="<?= $roles['id_role'] ?>" <?= ($pelanggan["fk_role"] == $roles['id_role']) ? "selected" : "" ?>><?= $roles['nama_role'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('role', '<small class="form-text text-danger">', '</small>'); ?>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</main><!-- End #main -->