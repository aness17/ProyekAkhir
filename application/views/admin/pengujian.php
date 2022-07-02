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
                    <h5 class="card-title">Lift Ratio</h5>
                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($kategori as $kategoris) : ?>
                                <tr style="text-align: center;">
                                    <td><?= $no; ?></td>
                                    <td><?= $kategoris['nama_kategori'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kategori/edit/' . $kategoris['id_kategori']) ?>" type="button" class="fas fa-edit" style="color:limegreen">Edit
                                        </a>
                                        <a href="<?= base_url('kategori/delete/' . $kategoris['id_kategori']) ?>" type="button" class="fas fa-trash" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">Hapus
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