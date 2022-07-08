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
                        <h5 class="card-title">Data pelanggan</h5>
                        <a href="<?= base_url('pelanggan/add') ?>" type="button" class="btn" style="font-size:25px;">
                            <i class="bi bi-plus-circle"></i> </a>
                    </div>

                    <!-- Table with hoverable rows -->
                    <table class="table datatable">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Role</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($pelanggan as $custs) : ?>
                                <tr style="text-align: center;">
                                    <td><?= $no; ?></td>
                                    <td><?= $custs['nama_pelanggan'] ?></td>
                                    <td><?= $custs['username_pelanggan'] ?></td>
                                    <td><?= $custs['alamat_pelanggan'] ?></td>
                                    <td><?= $custs['nohp_pelanggan'] ?></td>
                                    <td><?= $custs['nama_role'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('pelanggan/edit/' . $custs['id_pelanggan']) ?>" type="button" class="bi bi-pencil-square" style="color:limegreen">
                                        </a>
                                        <a href="<?= base_url('pelanggan/delete/' . $custs['id_pelanggan']) ?>" type="button" class="bi bi-trash-fill" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">
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