<section id="hero-animated" class="">

</section>
<main id="main">

    <section id="services" class="services" style="padding: 10px 0 !important;">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2 style="font-family: monospace;">Riwayat Pesanan</h2>
            </div>
            <div class="row gy-5">
                <div class="col-12">
                    <div>
                        <form action="" method="post">
                            <div class="row" id="form-bulan">
                                <div class="col-lg-2">
                                    <div>
                                        <input type="date" name="tanggal" id="tanggal" />
                                        <?= form_error('tanggal', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" id="tombol">Cek</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table tables-responsive datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Tanggal Pesan</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($transaksi as $r) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $r['nama_produk'] ?></td>
                                    <td><?= $r['tgl_pesanan'] ?></td>
                                    <td><?= $r['ket_jumlah'] ?></td>
                                    <td><?= $r['total_harga'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
</main>