<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/welcome
     *	- or -
     * 		http://example.com/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Umkm_model');
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
        $this->load->model('Transaksi_model');
        $this->load->model('DetailTransaksi_model');
        $this->load->library('Pdf');
        $this->load->library('Excel');

        if (empty($this->session->userdata('id'))) {
            redirect('auth/login');
        }
    }
    public function index()
    {
        $tgl = date('Y-m-d');
        $month = date('m');
        $year = date('Y');
        $ci = get_instance();
        if ($ci->session->userdata('id_role') == '2') {
            redirect('pemilik/');
        } elseif ($ci->session->userdata('id_role') == '1') {
            $trans = $this->Transaksi_model->trans_view_by_date($tgl);
            $transaksiperhari = $this->Transaksi_model->sumtrans_view_by_date($tgl);
            $transaksiperbulan = $this->Transaksi_model->sumtrans_view_by_month($month);
            $transaksipertahun = $this->Transaksi_model->sumtrans_view_by_year($year);
            $datacs = $this->User_model->sumcs();
            $dataproduk = $this->Produk_model->sumProduk();
            $datatrans = $this->Transaksi_model->selecttrans();
            $pendapatan = $this->Transaksi_model->sumharga()[0]->total_harga;
            $bestSeller = $this->DetailTransaksi_model->bestSeller();

            $data = [
                'datacs' => $datacs,
                'dataproduk' => $dataproduk,
                'datatrans' => $datatrans,
                'pendapatan' => $pendapatan,
                'trans' => $trans,
                'transaksiperhari' => $transaksiperhari,
                'transaksiperbulan' => $transaksiperbulan,
                'transaksipertahun' => $transaksipertahun,
                'bestSeller' => $bestSeller
            ];
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/index', $data);
            $this->load->view('templates/admin/footer');
        } else {
            redirect('auth/login');
        }
    }

    public function flasher($class, $message)
    {
        return
            '<div class="alert alert-' . $class . ' alert-dismissible fade show" role="alert">
                ' . $message . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }

    public function breadcomb()
    {
        $crumbs = explode("/", $_SERVER["REQUEST_URI"]);
        $roti = [];

        for ($i = 0; $i < count($crumbs); $i++) {
            $roti[$i] = ucfirst(str_replace(array(".php", "_"), array("", " "), $crumbs[$i]) . ' ');
        }

        return array_slice($roti, 3);
    }

    public function laporan()
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '1') {
            redirect('admin/');
        } else {
            if (isset($_POST['filter']) && !empty($_POST['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
                $filter = $_POST['filter']; // Ambil data filter yang dipilih user

                if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                    $tgl = $_POST['tanggal'];

                    $ket = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($tgl));
                    // $url_cetak = 'transaksi/cetak?filter=1&tanggal=' . $tgl;
                    $transaksi = $this->Transaksi_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
                } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                    $bulan = $_POST['bulan'];
                    $arr = explode('-', $bulan);
                    $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

                    $ket = 'Data Transaksi Bulan ' . $nama_bulan[intval($arr[1])] . ' ' . $arr[0];
                    // $url_cetak = 'transaksi/cetak?filter=2&bulan=' . $bulan . '&tahun=' . $arr[0];
                    $transaksi = $this->Transaksi_model->view_by_month($bulan); // Panggil fungsi view_by_month yang ada di TransaksiModel
                } else { // Jika filter nya 3 (per tahun)
                    $tahun = $_POST['tahun'];

                    $ket = 'Data Transaksi Tahun ' . $tahun;
                    // $url_cetak = 'transaksi/cetak?filter=3&tahun=' . $tahun;
                    $transaksi = $this->Transaksi_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
                }
            } else { // Jika user tidak mengklik tombol tampilkan
                $ket = 'Semua Data Transaksi';
                // $url_cetak = 'transaksi/cetak';
                $transaksi = $this->Transaksi_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
            }

            $data['ket'] = $ket;
            // $data['url_cetak'] = base_url('' . $url_cetak);
            $data['transaksi'] = $transaksi;
            $data['option_tahun'] = $this->Transaksi_model->option_tahun();
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/laporan', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    public function cetak($filter, $date)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '1') {
            redirect('admin/');
        } else {
            $table = [
                "No" => "5%",
                "Kode Transaksi" => "5%",
                "Nama Pelanggan" => "15%",
                "Alamat Pelanggan" => "15%",
                "Nama Produk" => "25%",
                "Jumlah Produk" => "5%",
                "Total Harga" => "15%",
                "Tgl Pesanan" => "15%",
            ];

            $judul = "Laporan Transaksi Viera Oleh-oleh";
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Laporan ' . $judul);
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->setPrintHeader(false);
            $pdf->SetAuthor('PCR');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage();

            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $transaksi = $this->Transaksi_model->view_by_date($date); // Panggil fungsi view_by_date yang ada di TransaksiModel
            } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                $transaksi = $this->Transaksi_model->view_by_month($date); // Panggil fungsi view_by_month yang ada di TransaksiModel
            } else { // Jika filter nya 3 (per tahun)
                $transaksi = $this->Transaksi_model->view_by_year($date); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
            $html = "<h3>$judul</h3>";

            $html .= '<table cellpadding="5" border="0.5">
                        <tr>';
            foreach ($table as $col => $q) {
                $html .= "<td style= 'font-size: 10px;' align='center' ><b>" . $col . "</b></td>";
            }

            $html .= '</tr>';
            // <th width="45%" align="center"><b>Nama Sampah</b></th>
            // <th width="15%" align="center"><b>Total Berat</b></th>
            // <th width="10%" align="center"><b>Satuan</b></th>
            // <th width="20%" align="center"><b>Total Harga</b></th>
            $no = 1;


            foreach ($transaksi as $data) {
                $html .= '<tr align="center">
                                <td width="5%" style = "font-size: 8px;">' . $no++ . '</td>
                                <td width="5%" style = "font-size: 8px;">' . $data->id_transaksi . '</td>
                                <td width="15%"style = "font-size: 8px;">' . $data->nama_pelanggan . '</td>
                                <td width="15%" style = "font-size: 8px;">' . $data->alamat_pelanggan . '</td>
                                <td width="25%" style = "font-size: 8px;">' . $data->nama_produk . '</td>
                                <td width="5%" style = "font-size: 8px;">' . $data->ket_jumlah . '</td>
                                <td width="15%" style = "font-size: 8px;">Rp' . $data->total_harga . '</td>
                                <td width="15%" style = "font-size: 8px;">' . $data->tgl_pesanan . '</td>
                            </tr>';
            }
            $html .= '</table>';
            // var_dump($html);
            // die;
            $pdf->writeHTML($html, true, 0, true, 0);
            $pdf->Output('Laporan Transaksi Viera.pdf', 'I');
        }
    }
    public function pengujian()
    {
        $this->load->library('customautoloader');
        $ci = get_instance();
        if ($ci->session->userdata('id') != '1') {
            redirect('pemilik/');
        } else {
            $transaksi = $this->Transaksi_model->selectAll();
            $data_item = [];
            foreach ($transaksi as $t) {
                array_push($data_item, ["id" => $t["id_transaksi"], "item" => $t["nama_produk"]]);
            };

            $apriori = new helpers\apriori();
            $pengujian = $apriori->main($data_item);
            $result = [];
            foreach ($pengujian as $p) {
                $item = array(
                    "nama_produk" => $p['item'] . " , " . $p["val"],
                    "val" => $this->Transaksi_model->getB($p["val"])["jumlah"],
                    "sc" => $p["sc"],
                    "c" => $p["c"],
                    "benchmark" => ($this->Transaksi_model->getB($p["val"])["jumlah"] / count($this->Transaksi_model->selectAll())) * 100,
                );
                $item["ratio"] = $item["benchmark"] > 0 ? $item["c"] / $item["benchmark"]  : 0;
                $result[] = $item;
            }
            // echo "<pre>";
            // print_r($pengujian);
            // echo "</pre>";
            // die;
            $data["pengujian"] = $result;
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/pengujian', $data);
            $this->load->view('templates/admin/footer');
        }
    }
}
