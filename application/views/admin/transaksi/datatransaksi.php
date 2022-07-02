<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Transaksi</h5>

                    <!-- Table with hoverable rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah Produk</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($trans as $transs) : ?>
                                <tr style="text-align: center;">
                                    <td><?= $no; ?></td>
                                    <td><?= $transs['id_transaksi'] ?></td>
                                    <td><?= $transs['nama_pelanggan'] ?></td>
                                    <td><?= $transs['nama_produk'] ?></td>
                                    <td><?= $transs['ket_jumlah'] ?></td>
                                    <td><?= $transs['total_harga'] ?></td>
                                    <td><?= $transs['tgl_pesanan'] ?></td>
                                    <td><?= $transs['tgl_selesai'] ?></td>
                                    <td><?= $transs['status'] ?></td>

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