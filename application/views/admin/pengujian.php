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
                    <h5 class="card-title">Lift Ratio</h5>
                    <!-- Table with hoverable rows -->
                    <table class="table datatable">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">X</th>
                                <th scope="col">Y</th>
                                <th scope="col">SC</th>
                                <th scope="col">Confidence</th>
                                <th scope="col">Bencmark</th>
                                <th scope="col">Lift Ratio</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 1;
                            // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                            foreach ($pengujian as $p) : ?>
                                <tr style="text-align: center;">
                                    <td><?= $no; ?></td>
                                    <td><?= $p["nama_produk"] ?></td>
                                    <td><?= $p["x"] ?></td>
                                    <td><?= $p["y"] ?></td>
                                    <td><?= $p["sc"] ?></td>
                                    <td><?= $p["c"] ?></td>
                                    <td><?= $p["benchmark"] ?></td>
                                    <td><?= $p["ratio"] ?></td>
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