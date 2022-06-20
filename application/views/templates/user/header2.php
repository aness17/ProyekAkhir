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

    <!-- =======================================================
  * Template Name: HeroBiz - v2.0.0
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>Viera Oleh-oleh</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>

                    <li class="dropdown"><a href="<?= base_url('auth/') ?>"><span>Home</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    </li>

                    <li class="dropdown"><a href="<?= base_url('auth/produk') ?>"><span>Produk</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>

                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="<?= base_url('auth/riwayat') ?>">Riwayat Pesanan</a></li>
                    <li><a class="nav-link scrollto" href="index.html#about">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('auth/alamat') ?>">Alamat</a></li>
                    <li><a class="nav-link scrollto" href="index.html#contact">Kontak</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav><!-- .navbar -->

            <a class="btn-getstarted scrollto" href=<?= base_url('auth/logout') ?>>Keluar</a>

        </div>
    </header><!-- End Header -->