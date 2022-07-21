<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemilik extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
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
        // $this->load->library('Excel');

        if (empty($this->session->userdata('id'))) {
            redirect('index.php/auth/login');
        }
    }
    public function index()
    {
        $tgl = date('Y-m-d');
        $ci = get_instance();
        if ($ci->session->userdata('id_role') == '1') {
            redirect('admin/');
        } elseif ($ci->session->userdata('id_role') == '3') {
            redirect('auth/login');
        } elseif ($ci->session->userdata('id_role') == '2') {
            $trans = $this->Transaksi_model->trans_view_by_date($tgl);
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
                "bestSeller" => $bestSeller
            ];
            $this->load->view('templates/pemilik/header');
            $this->load->view('templates/pemilik/sidebar');
            $this->load->view('pemilik/index', $data);
            $this->load->view('templates/pemilik/footer');
        } else {
            redirect('auth/login');
        }
    }
    public function laporan()
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '5') {
            redirect('pemilik/');
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
            $this->load->view('templates/pemilik/header');
            $this->load->view('templates/pemilik/sidebar');
            $this->load->view('pemilik/laporan', $data);
            $this->load->view('templates/pemilik/footer');
        }
    }
    public function cetak($filter, $date)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '5') {
            redirect('pemilik/');
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
                $html .= "<td width=' . $q . ' style= 'font-size: 8px;' align='center' ><b>" . $col . "</b></td>";
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

            $pdf->writeHTML($html, true, 0, true, 0);
            $pdf->Output('Laporan Transaksi Viera.pdf', 'I');
        }
    }
}
