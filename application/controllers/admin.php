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
        $this->load->library('Pdf');
        $this->load->library('Excel');

        if (empty($this->session->userdata('id'))) {
            redirect('auth/login');
        }
    }
    public function index()
    {
        $tgl = date('Y-m-d');
        $ci = get_instance();
        if ($ci->session->userdata('id_role') == '2') {
            redirect('pemilik/');
        } elseif ($ci->session->userdata('id_role') == '1') {
            $trans = $this->Transaksi_model->trans_view_by_date($tgl);
            $datacs = $this->User_model->sumcs();
            $dataproduk = $this->Produk_model->sumProduk();
            $datatrans = $this->Transaksi_model->selecttrans();
            $pendapatan = $this->Transaksi_model->sumharga()[0]->total_harga;


            $data = [
                'datacs' => $datacs,
                'dataproduk' => $dataproduk,
                'datatrans' => $datatrans,
                'pendapatan' => $pendapatan,
                'trans' => $trans
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
    // public function apriori()
    // {
    //     $ci = get_instance();
    //     if ($ci->session->userdata('id') != '1') {
    //         redirect('pemilik/');
    //     } else {
    //         $transaksi = $this->Transaksi_model->selectAll();

    //         $data = [
    //             'transaksi' => $transaksi
    //         ];
    //         $this->load->view('templates/admin/header');
    //         $this->load->view('templates/admin/sidebar');
    //         $this->load->view('admin/apriori', $data);
    //         $this->load->view('templates/admin/footer');
    //     }
    // }
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
        if ($ci->session->userdata('id') != '8') {
            redirect('index.php/superadmin/');
        } else {
            $table = [
                "No",
                "Nama Customer",
                "Alamat",
                "Jenis Laundry",
                "Jenis Layanan",
                "Tgl Order",
                "Tgl Jemput",
                "Tgl Antar",
                "Jumlah",
                "Harga",
                "Status",
            ];

            $judul = "Laporan Transaksi Laundry";
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
            foreach ($table as $col) {
                $html .= "<th align='center'><b>" . $col . "</b></th>";
            }
            $html .= '</tr>';
            // <th width="45%" align="center"><b>Nama Sampah</b></th>
            // <th width="15%" align="center"><b>Total Berat</b></th>
            // <th width="10%" align="center"><b>Satuan</b></th>
            // <th width="20%" align="center"><b>Total Harga</b></th>
            $no = 1;


            foreach ($transaksi as $data) {
                $html .= '<tr align="center">
                                <td>' . $no++ . '</td>
                                <td>' . $data->nama_cs . '</td>
                                <td>' . $data->alamat_cs . '</td>
                                <td>' . $data->nama_jenis . '</td>
                                <td>' . $data->nama_layanan . '</td>
                                <td>' . $data->tgl_order . '</td>
                                <td>' . $data->tgl_pickup . '</td>
                                <td>' . $data->tgl_antar . '</td>
                                <td>' . $data->ket_jumlah . '</td>
                                <td>' . $data->harga . '</td>
                                <td>' . $data->status . '</td>
                            </tr>';
            }
            $html .= '</table>';

            $pdf->writeHTML($html, true, 0, true, 0);
            $pdf->Output('Laporan Transaksi Laundry.pdf', 'I');
        }
    }
    public function cetakexcel($filter, $date)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('index.php/superadmin/');
        } else {
            $table = [
                ["alphabet" => "A", "column" => "No"],
                ["alphabet" => "B", "column" => "Nama Customer"],
                ["alphabet" => "C", "column" => "Alamat"],
                ["alphabet" => "D", "column" => "Jenis Laundry"],
                ["alphabet" => "E", "column" => "Jenis Layanan"],
                ["alphabet" => "F", "column" => "Tgl Order"],
                ["alphabet" => "G", "column" => "Tgl Jemput"],
                ["alphabet" => "H", "column" => "Tgl Antar"],
                ["alphabet" => "I", "column" => "Jumlah"],
                ["alphabet" => "J", "column" => "Harga"],
                ["alphabet" => "K", "column" => "Status"],
            ];

            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $transaksi = $this->Transaksi_model->view_by_date($date); // Panggil fungsi view_by_date yang ada di TransaksiModel
            } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                $transaksi = $this->Transaksi_model->view_by_month($date); // Panggil fungsi view_by_month yang ada di TransaksiModel
            } else { // Jika filter nya 3 (per tahun)
                $transaksi = $this->Transaksi_model->view_by_year($date); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
            $excel = new PHPExcel();
            // Settingan awal fil excel
            $excel->getProperties()->setCreator('PCR')
                ->setTitle("Laporan Transaksi Laundry")
                ->setSubject("Transaksi")
                ->setDescription("Laporan Transaksi Laundry");
            // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
            $style_col = array(
                'font' => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
                )
            );
            // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
            $style_row = array(
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
                )
            );
            // $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
            // $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
            // $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            // $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

            $numrow = 1;

            foreach ($table as $value) {
                $excel->setActiveSheetIndex(0)->setCellValue($value["alphabet"] . $numrow, $value["column"]);
                $excel->getActiveSheet()->getStyle($value["alphabet"] . $numrow)->applyFromArray($style_col);
            }
            $numrow++;
            $no = 1;

            foreach ($transaksi as $data) { // Lakukan looping pada variabel siswa
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nama_cs);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->alamat_cs);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->nama_jenis);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->nama_layanan);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->tgl_order);
                $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->tgl_pickup);
                $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->tgl_antar);
                $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->ket_jumlah);
                $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->harga);
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data->status);
                foreach ($table as $value) {
                    $excel->getActiveSheet()->getStyle($value["alphabet"] . $numrow)->applyFromArray($style_row);
                }
                $no++;
                $numrow++;

                // echo $numrow;

            }

            foreach ($table as $value) {
                $excel->getActiveSheet()->getColumnDimension($value['alphabet'])->setAutoSize(true);
            }

            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $excel->getActiveSheet(0)->setTitle("Laporan Laundry");
            $excel->setActiveSheetIndex(0);
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Laporan Transaksi Laundry.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            ob_end_clean();
            $write->save('php://output');
            // var_dump($transaksi);

            // echo "a", "b", "c", "d";
        }
    }
}
