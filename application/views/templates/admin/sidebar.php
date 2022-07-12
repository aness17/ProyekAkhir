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
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="<?= base_url('produk/dataproduk/') ?>">
                <i class="bi bi-layout-text-window-reverse"></i><span>Data Produk</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link collapsed" href="<?= base_url('produk/dataproduk/') ?>">
                        <i class="bi bi-layout-text-window-reverse"></i><span>Semua Produk</span><i></i>
                        <?php
                        $produk = $this->db->query("SELECT * FROM kategori order by nama_kategori ASC");
                        foreach ($produk->result_array() as $kategoris) : ?>

                            <a class="nav-link collapsed" href="<?= base_url('produk/dataproduk/') ?>">
                                <i class="bi bi-layout-text-window-reverse"></i><span><?= $kategoris['nama_kategori'] ?></span><i></i>
                            </a><?php endforeach; ?>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('transaksi/datatransaksi/') ?>">
                <i class="bi bi-layout-text-window-reverse"></i><span>Data Transaksi</span><i></i>
            </a>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('admin/laporan/') ?>">
                <i class="bi bi-clipboard-data"></i><span>Laporan</span><i></i>
            </a>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('admin/pengujian/') ?>">
                <i class="bi bi-clipboard-data"></i><span>Pengujian</span><i></i>
            </a>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('admin/apriori/') ?>">
                <i class="bi bi-clipboard-data"></i><span>Apriori</span><i></i>
            </a>
        </li><!-- End Tables Nav -->

    </ul>

</aside><!-- End Sidebar-->