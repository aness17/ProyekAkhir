<section id="hero-animated" class="">

</section>
<main id="main">
    <div class="section-header">
        <h2>Riwayat Pesanan</h2>
    </div>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row gy-5">
                <div class="col-12">
                    <table class="table table-responsive">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Tanggal Pesan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                        </tr>
                        <?php $no = 1;
                        // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                        foreach ($riwayat as $r) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $r['nama_produk'] ?></td>
                                <td><?= $r['tgl_pesanan'] ?></td>
                                <td><?= $r['ket_jumlah'] ?></td>
                                <td><?= $r['harga_produk'] ?></td>
                                <td><?= $r['ket_jumlah'] * $r['harga_produk'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>