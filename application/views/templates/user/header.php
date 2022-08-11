<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Viera Oleh-oleh</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href=<?= base_url('assets/pelanggan/assets/img/favicon.png') ?> rel="icon">
    <link href=<?= base_url('assets/pelanggan/assets/img/apple-touch-icon.png') ?> rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href=<?= base_url('assets/pelanggan/assets/vendor/bootstrap/css/bootstrap.min.css') ?> rel="stylesheet">
    <link href=<?= base_url('assets/pelanggan/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?> rel="stylesheet">
    <link href=<?= base_url('assets/pelanggan/assets/vendor/aos/aos.css') ?> rel="stylesheet">
    <link href=<?= base_url('assets/pelanggan/assets/vendor/glightbox/css/glightbox.min.css') ?> rel="stylesheet">
    <link href=<?= base_url('assets/pelanggan/assets/vendor/swiper/swiper-bundle.min.css') ?> rel="stylesheet">
    <link href="<?= base_url('assets/') ?>admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">


    <!-- Variables CSS Files. Uncomment your preferred color scheme -->
    <link href=<?= base_url('assets/pelanggan/assets/css/variables.css') ?> rel="stylesheet">
    <!-- <link href="assets/css/variables-blue.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/variables-green.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/variables-orange.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/variables-purple.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/variables-red.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/variables-pink.css" rel="stylesheet"> -->

    <!-- Template Main CSS File -->

    <link href=<?= base_url('assets/pelanggan/assets/css/main.css') ?> rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script> -->

    <!-- =======================================================
  * Template Name: HeroBiz - v2.0.0
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0" style="background-color: gold;">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="<?= base_url('') ?>" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>Viera Oleh-oleh</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li class="dropdown"><a href="<?= base_url('') ?>"><span>Home</span></a>
                    </li>
                    <li class="dropdown"><a href="<?= base_url('auth/produk') ?>"><span>Produk</span> </a>
                        <!-- <ul>
                            <?php
                            $kategori = $this->db->query("SELECT * FROM kategori order by nama_kategori ASC");
                            foreach ($kategori->result_array() as $kategoris) : ?>
                                <li><a href="<?= base_url('auth/produk/' . $kategoris['nama_kategori']) ?>"><?= $kategoris['nama_kategori'] ?></a>
                                </li> <?php endforeach; ?>
                        </ul> -->
                    </li>
                    <li><a class="nav-link scrollto" href="<?= base_url('auth/tentang') ?>">Tentang</a></li>
                    <div class="md-form">
                        <select class="produkSelect form-control mr-sm-2" id="produkSelect">
                            <option value="" disabled selected>Search</option>
                            <?php foreach ($produk as $p) : ?>
                                <option value="<?= $p["id_produk"] ?>"><?= $p["nama_produk"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->
            <a class="btn-getstarted scrollto bg-success" href=<?= base_url('auth/login/') ?>>Login</a>
        </div>
    </header><!-- End Header -->