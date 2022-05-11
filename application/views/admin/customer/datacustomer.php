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
                    <h5 class="card-title">Data Customer</h5>
                    <a href="<?= base_url('customer/addcustomer') ?>" type="button" class="btn btn-success text-white btn-sm">
                        Tambah
                    </a>

                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Role</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($customer as $custs) : ?>
                                <tr style="text-align: center;">
                                    <td><?= $no; ?></td>
                                    <td><?= $custs['nama_pelanggan'] ?></td>
                                    <td><?= $custs['username_pelanggan'] ?></td>
                                    <td><?= $custs['password_pelanggan'] ?></td>
                                    <td><?= $custs['alamat_pelanggan'] ?></td>
                                    <td><?= $custs['nohp_pelanggan'] ?></td>
                                    <td><?= $custs['fk_role'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kategori/edit/' . $custs['id_pelanggan']) ?>" type="button" class="fas fa-edit" style="color:limegreen">Edit
                                        </a>
                                        <a href="<?= base_url('kategori/delete/' . $custs['id_pelanggan']) ?>" type="button" class="fas fa-trash" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">Hapus
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