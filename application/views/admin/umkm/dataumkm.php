<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">

                        <h5 class="card-title">Data UMKM</h5>
                        <a href="<?= base_url('umkm/addumkm') ?>" type="button" class="btn" style="font-size:25px;">
                            <i class="bi bi-plus-circle"></i> </a>
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Nama UMKM</th>
                                <th scope="col">Alamat UMKM</th>
                                <th scope="col">No. Telp UMKM</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($umkm as $umkms) : ?>
                                <tr style="text-align: center;">
                                    <td><?= $no; ?></td>
                                    <td><?= $umkms['nama_umkm'] ?></td>
                                    <td><?= $umkms['alamat_umkm'] ?></td>
                                    <td><?= $umkms['notelp_umkm'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('umkm/edit/' . $umkms['id_umkm']) ?>" type="button" class="bi bi-pencil-square" style="color:limegreen">
                                        </a>
                                        <a href="<?= base_url('umkm/delete/' . $umkms['id_umkm']) ?>" type="button" class="bi bi-trash-fill" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">
                                        </a>
                                    </td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End Table with hoverable rows -->

                </div>
            </div>


        </div>
    </section>

</main><!-- End #main -->