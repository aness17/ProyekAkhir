<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laundry Yuk - Daftar</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets') ?>/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets') ?>/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                                    </div>
                                    <form method="POST" action="<?= base_url('index.php/login/register') ?>">
                                        <div class="form-group">
                                            <input type="name" class="form-control form-control-user" name="nama" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Nama Lengkap">
                                            <?= form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>

                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Alamat Email">
                                            <?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="passwd" id="exampleInputPassword" placeholder="Kata Sandi">
                                            <?= form_error('passwd', '<small class="form-text text-danger">', '</small>'); ?>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="passwd" id="exampleInputPassword" placeholder="Konfirmasi Kata Sandi">
                                            <?= form_error('passwd', '<small class="form-text text-danger">', '</small>'); ?>

                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('index.php/auth/login') ?>">Sudah mempunyai akun? Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets') ?>/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets') ?>/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets') ?>/admin/js/sb-admin-2.min.js"></script>

</body>

</html>