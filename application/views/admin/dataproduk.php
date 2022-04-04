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
                    <h5 class="card-title">Data Produk</h5>

                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Keterangan Produk</th>
                                <th scope="col">Harga Produk</th>
                                <th scope="col">Stock Produk</th>
                                <th scope="col">Foto Produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">UMKM</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($produk as $produks) : ?>
                                <tr style="text-align: center;">
                                    <td><?= $no; ?></td>
                                    <td><?= $produks['nama_produk'] ?></td>
                                    <td><?= $produks['keterangan_produk'] ?></td>
                                    <td><?= $produks['harga_produk'] ?></td>
                                    <td><?= $produks['stok_produk'] ?></td>
                                    <td><?= $produks['foto_produk'] ?></td>
                                    <td><?= $produks['fk_kategori'] ?></td>
                                    <td><?= $produks['fk_umkm'] ?></td>

                                    <td class="text-center">
                                        <a href="<?= base_url('index.php/superadmin/edit/' . $produks['id_produk']) ?>" type="button" class="fas fa-edit" style="color:limegreen">
                                        </a>
                                        <a href="<?= base_url('index.php/superadmin/delete/' . $produks['id_produk']) ?>" type="button" class="fas fa-trash" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">
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