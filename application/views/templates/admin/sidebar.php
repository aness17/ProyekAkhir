<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="<?= base_url('admin/') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('pelanggan/data/') ?>">
                <i class="bi bi-layout-text-window-reverse"></i><span>Data Pelanggan</span><i></i>
            </a>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('transaksi/datatransaksi/') ?>">
                <i class="bi bi-layout-text-window-reverse"></i><span>Data Transaksi</span><i></i>
            </a>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('produk/dataproduk/') ?>">
                <i class="bi bi-layout-text-window-reverse"></i><span>Data Produk</span><i></i>
            </a>
            <ul>
                <?php
                $umkm = $this->db->query("SELECT * FROM kategori order by nama_kategori ASC");
                foreach ($umkm->result_array() as $kategoris) : ?>

                    <a class="nav-link collapsed" href="<?= base_url('produk/dataproduk/') ?>">
                        <i class="bi bi-layout-text-window-reverse"></i><span><?= $kategoris['nama_kategori'] ?></span><i></i>
                    </a><?php endforeach; ?>
            </ul>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('kategori/datakategori/') ?>">
                <i class="bi bi-layout-text-window-reverse"></i><span>Data Kategori</span><i></i>
            </a>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('umkm/dataumkm/') ?>">
                <i class="bi bi-layout-text-window-reverse"></i><span>Data UMKM</span><i></i>
            </a>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('admin/laporan/') ?>">
                <i class="bi bi-clipboard-data"></i><span>Laporan</span><i></i>
            </a>
        </li><!-- End Tables Nav -->

    </ul>

</aside><!-- End Sidebar-->