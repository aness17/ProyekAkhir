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

    <!-- Left side columns -->
    <div class="row">
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
    </div>
    <div class="row">
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
    </div>
    <div class="row">
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
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Penjualan Tahun </h5>
            <select id="tahun" class="ml-3">
              <option value="-">Semua Tahun</option>
              <?php foreach ($tahun as $r) : ?>
                <option value="<?= $r['tahun'] ?>"><?= $r['tahun'] ?></option>
              <?php endforeach; ?>
            </select>
            <canvas id="myChart" width="400" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Recent Sales -->
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
                    </div>
                  </div>
                </div><!-- End Service Item -->
              <?php endforeach; ?>
            </div>
          </div>

        </div><!-- End Recent Sales -->
      </div>

    </div>
  </section>
  <script>
    const fetchData = async (url) => {
      const response = await fetch(url);
      const data = await response.json();
      return new Promise((resolve, reject) => {
        resolve(data);
      })
    }

    const item = async (tahun) => {
      //kelompok
      let transaksi = await fetchData(`<?= base_url() ?>/pemilik/transaksiperbulan/${tahun}`);

      var data = {
        series: transaksi.map((s) => parseInt(s.jumlah)),
        labels: transaksi.map((s) => s.tgl)
      };
      const ctx = document.getElementById('myChart').getContext('2d');
      //tarok sini

      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [{
            label: '# of Votes',
            data: data.series,
            backgroundColor: ["#a568ab", "#ab72b0", "#b598b8"],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
    document.getElementById('tahun').addEventListener('change', (e) => {
      item(e.target.value);
    });
    item('-');
  </script>

</main><!-- End #main -->