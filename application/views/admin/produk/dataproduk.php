<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item">Data Produk</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Data Produk</h5>
                        <a href="<?= base_url('produk/addproduk') ?>" type="button" class="btn" style="font-size:25px;">
                            <i class="bi bi-plus-circle"></i> </a>
                    </div>

                    <!-- Table with hoverable rows -->
                    <table class="table table datatable">
                        <thead style="text-align:center ;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Keterangan Produk</th>
                                <th scope="col">Harga Produk</th>
                                <th scope="col">Stock Produk</th>
                                <th scope="col">Foto Produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">UMKM</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($produk as $produks) : ?>
                                <tr style="text-align: left; font-size: small;">
                                    <td><?= $no; ?></td>
                                    <td><?= $produks['nama_produk'] ?></td>
                                    <td><?= $produks['keterangan_produk'] ?></td>
                                    <td><?= $produks['harga_produk'] ?></td>
                                    <td><?= $produks['stok_produk'] ?>
                                        <?php if ($produks['nama_kategori'] == "Minuman" || $produks['nama_kategori'] == "Dessert" || $produks['nama_kategori'] == "Snack") : ?>
                                            pcs
                                        <?php else : ?>
                                            kotak
                                        <?php endif; ?>
                                    </td>
                                    <td><img class="img-fluid" src="<?= base_url('produk/') . $produks['foto_produk'] ?>" alt="" style="width:75px ;"></td>
                                    <td><?= $produks['nama_kategori'] ?></td>
                                    <td><?= $produks['nama_umkm'] ?></td>

                                    <td class="text-center">
                                        <a href="<?= base_url('produk/edit/' . $produks['id_produk']) ?>" type="button" class="bi bi-pencil-square" style="color:limegreen">
                                        </a>
                                        <a href="<?= base_url('produk/delete/' . $produks['id_produk']) ?>" type="button" class="bi bi-trash-fill" style="color:red" onclick="return confirm('Are you sure to delete this row ?')">
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