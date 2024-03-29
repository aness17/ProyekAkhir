<!-- <?php phpinfo(); ?> -->
<!-- Begin Page Content -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan</h1>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-12 col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="card-body">
                                    <br>
                                    <div class="form-group mb-3">
                                        <h5 class="card-title">Filter Berdasarkan</span></h5>
                                        <select name="filter" id="filter" class="form-control">
                                            <option value="1">Tanggal</option>
                                            <option value="2">Bulan</option>
                                            <option value="3">Tahun</option>
                                        </select>
                                    </div>
                                    <div class="row flex-row" id="form-tanggal">
                                        <div class="col-lg-3">
                                            <div>
                                                <h5 class="card-title">Dari Tanggal</span></h5>
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <h5 class="card-title">Sampai Tanggal</span></h5>
                                                <input type="date" name="tanggal2" id="tanggal" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="form-bulan">
                                        <div class="col-lg">
                                            <div>
                                                <h5 class="card-title">Bulan</h5>
                                                <input type="month" name="bulan" id="bulan" class="form-control" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="form-tahun">
                                        <div class="col-lg">
                                            <div>
                                                <h5 class="card-title">Tahun</h5>
                                                <select name="tahun" id="tahun" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <?php
                                                    foreach ($option_tahun as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                                        echo '<option value="' . $data->tahun . '">' . $data->tahun . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-lg-4 mb-4 ">
                                    <button type="submit" id="tombol" disabled>Tampilkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title"><?php echo $ket; ?></span></h5>
                        <a id="cetak" type="button" class="btn" style="font-size:25px;">
                            Text to PDF<i class="bi bi-file-earmark-pdf-fill"></i> </a>
                    </div>

                    <table class="table table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah Produk</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th scope="col">Total Harga</th>

                                <!-- <th scope="col">Tanggal Selesai</th> -->
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            if (!empty($transaksi)) {
                                $no = 1;


                                foreach ($transaksi as $data) {
                                    $tgl_pesanan = date('d-m-Y', strtotime($data->tgl_pesanan));

                                    echo "<tr style='text-align: center;'>";
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $data->id_transaksi . "</td>";
                                    echo "<td>" . $data->nama_pelanggan . "</td>";
                                    echo "<td>" . $data->nama_produk . "</td>";
                                    echo "<td>" . $data->ket_jumlah . "</td>";

                                    echo "<td>" . $tgl_pesanan . "</td>";
                                    echo "<td>Rp" . number_format($data->total_harga, 0, ",", ".") . "</td>";
                                    echo "<td>" . $data->status . "</td>";
                                    echo "</tr>";
                                    $no++;
                                }
                            }
                            ?>
                        </tbody>

                        <script>
                            const formtanggal = document.getElementById("form-tanggal")
                            const formbulan = document.getElementById("form-bulan")
                            const formtahun = document.getElementById("form-tahun")
                            const filter = document.getElementById("filter")
                            const tombol = document.getElementById("tombol")
                            const cetak = document.getElementById("cetak")
                            // const cetakexcel = document.getElementById("cetakexcel")
                            const tanggal = document.getElementById("tanggal")
                            const bulan = document.getElementById("bulan")
                            const tahun = document.getElementById("tahun")

                            formtanggal.addEventListener("change", (e) => {
                                e.preventDefault()
                                tombol.disabled = (e.target.value == null)
                            })
                            formbulan.addEventListener("change", (e) => {
                                e.preventDefault()
                                tombol.disabled = (e.target.value == null)
                            })
                            formtahun.addEventListener("change", (e) => {
                                e.preventDefault()
                                tombol.disabled = (e.target.value == "")
                            })

                            cetak.addEventListener("click", (e) => {
                                console.log(`<?= base_url() ?>pemilik/cetak/${sessionStorage.getItem('filter')}/${sessionStorage.getItem('date')}`)
                                location.href = `<?= base_url() ?>pemilik/cetak/${sessionStorage.getItem('filter')}/${sessionStorage.getItem('date')}`
                            })
                            // cetakexcel.addEventListener("click", (e) => {
                            //     console.log(`<?= base_url() ?>admin/cetakexcel/${sessionStorage.getItem('filter')}/${sessionStorage.getItem('date')}`)
                            //     location.href = `<?= base_url() ?>admin/cetakexcel/${sessionStorage.getItem('filter')}/${sessionStorage.getItem('date')}`
                            // })
                            tombol.addEventListener("click", (e) => {
                                const a = filter.value
                                let date = ''

                                if (a == '1') { // Jika filter nya 1 (per tanggal)
                                    date = tanggal.value
                                } else if (a == '2') { // Jika filter nya 2 (per bulan)
                                    date = bulan.value
                                } else if (a == '3') { // Jika filternya 3 (per tahun)
                                    date = tahun.value
                                }
                                sessionStorage.setItem('date', date)
                                sessionStorage.setItem('filter', a)

                            })

                            formbulan.style.display = "none"
                            formtahun.style.display = "none"

                            // sessionStorage.setItem('filter', '1')

                            filter.addEventListener("change", (e) => {
                                e.preventDefault()
                                const q = e.target.value
                                formtanggal.style.display = "none"
                                formbulan.style.display = "none"
                                formtahun.style.display = "none"
                                sessionStorage.setItem('filter', q)


                                if (q == '1') { // Jika filter nya 1 (per tanggal)
                                    formtanggal.style.display = "flex"
                                } else if (q == '2') { // Jika filter nya 2 (per bulan)
                                    formbulan.style.display = "block"
                                } else if (q == '3') { // Jika filternya 3 (per tahun)
                                    formtahun.style.display = "block"
                                }
                            })
                        </script>
                        <!-- <script>
                        $(document).ready(function() { // Ketika halaman selesai di load
                            $('.input-tanggal').datepicker({
                                dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
                            });

                            $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

                            $('#filter').change(function() { // Ketika user memilih filter
                                if (q == '1') { // Jika filter nya 1 (per tanggal)
                                    $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                                    $('#form-tanggal').show(); // Tampilkan form tanggal
                                } else if (q == '2') { // Jika filter nya 2 (per bulan)
                                    $('#form-tanggal').hide(); // Sembunyikan form tanggal
                                    $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
                                } else { // Jika filternya 3 (per tahun)
                                    $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                                    $('#form-tahun').show(); // Tampilkan form tahun
                                }

                                $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
                            })
                        })
                    </script> -->
                    </table>
                </div>

            </div>
        </div>


        <!-- Top Selling -->

        </div>

        </div>
        </div>
        </div>
        </div>
    </section>

</main><!-- End #main -->