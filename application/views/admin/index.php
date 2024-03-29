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

      <!-- Left side columns -->
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Transaksi</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $datatrans ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Sales Card -->

        <div class="col-xxl-3 col-md-3">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Transaksi Perhari </h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $transaksiperhari ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Revenue Card -->
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Transaksi Perbulan </h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $transaksiperbulan ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Revenue Card -->
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Transaksi Pertahun </h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $transaksipertahun ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Revenue Card -->

        <div class="col-xxl-3 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Produk</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $dataproduk ?></h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Sales Card -->
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Pelanggan</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-fill"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $datacs ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Sales Card -->
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Pelanggan Perhari</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-fill"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $datacshari ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Sales Card -->
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">UMKM</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-fill"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $dataumkm ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Sales Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Pendapatan Perhari </h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash"></i>
                </div>
                <div class="ps-3">
                  <h5 style="font-weight: bold;">Rp <?= number_format($pendapatanperhari, 0, ",", "."); ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Revenue Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Pendapatan Perbulan </h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash"></i>
                </div>
                <div class="ps-3">
                  <h5 style="font-weight: bold;">Rp <?= number_format($pendapatanperbulan, 0, ",", "."); ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Revenue Card -->
        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Pendapatan Pertahun</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash"></i>
                </div>
                <div class="ps-3">
                  <h5 style="font-weight: bold;">Rp <?= number_format($pendapatan, 0, ",", "."); ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Revenue Card -->

        <div class="col-12">
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Produk Terlaris</h5>

              <div class="row gy-4 d-flex mt-4">
                <?php foreach ($bestSeller as $produks) : ?>
                  <div class="col-xl-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item mb-3">
                      <div class="details position-relative" style="margin: -20px 30px!important;">

                        <img class="img-fluid" src="<?= base_url('produk/') . $produks['foto_produk'] ?>" style="height: 200px; object-fit:cover; object-position:center;" alt="">

                        <h3 style="font-size:medium ;"><?= $produks['nama_produk'] ?></h3>
                        <h3 style="font-size:medium ;"><?= $produks['ket_jumlah'] ?> pcs</h3>

                      </div>
                    </div>
                  </div><!-- End Service Item -->
                <?php endforeach; ?>
              </div>
            </div>

          </div><!-- End Recent Sales -->
        </div>

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="card-body pb-0">
              <h5 class="card-title">Data Transaksi <span>| Hari ini</span></h5>

              <table class="table table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Transaksi</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Produk</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Tanggal Pesanan</th>
                    <!-- <th scope="col">Tanggal Selesai</th> -->
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
                      <!-- <td><?= $transs['tgl_selesai'] ?></td> -->
                      <td><?= $transs['status'] ?></td>

                    </tr>
                  <?php $no++;
                  endforeach; ?>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Top Selling -->

      </div>


    </div>
  </section>

</main><!-- End #main -->