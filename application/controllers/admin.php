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


        // $this->load->model('Transaksi_model');
        // $this->load->library('Pdf');
        // $this->load->library('Excel');

        // if (empty($this->session->userdata('id'))) {
        //     redirect('auth/login');
        // }

    }
    public function index()
    {

        $ci = get_instance();
        // if ($ci->session->userdata('id_role') == '2') {
        //     redirect('outlet/');
        // } elseif ($ci->session->userdata('id_role') == '4') {
        //     redirect('agen/');
        // } elseif ($ci->session->userdata('id_role') == '3') {


        $datacs = $this->User_model->sumcs();
        //     $dataagen = $this->User_model->sumagen();
        //     $dataoutlet = $this->User_model->sumoutlet();
        //     $datajemput = $this->Transaksi_model->select('Menunggu Penjemputan');
        //     $dataproses = $this->Transaksi_model->select('Pesanan Diproses');
        //     $datadiantar = $this->Transaksi_model->select('Pesanan Diantar');
        //     $dataselesai = $this->Transaksi_model->select('selesai');
        $datatrans = $this->Transaksi_model->selecttrans();
        $pendapatan = $this->Transaksi_model->sumharga()[0]->total_harga;
        //     $pendapatanproses = $this->Transaksi_model->sumhargaproses()[0]->harga;
        //     $pendapatantotal = $this->Transaksi_model->sumhargatotal()[0]->harga;


        $data = [
            'datacs' => $datacs,
            //         'dataagen' => $dataagen,
            //         'dataoutlet' => $dataoutlet,
            //         'datajemput' => $datajemput,
            //         'dataproses' => $dataproses,
            //         'datadiantar' => $datadiantar,
            //         'dataselesai' => $dataselesai,
            'datatrans' => $datatrans,
            //         'mp' => $mp,
            'pendapatan' => $pendapatan,
            //         'pendapatanproses' => $pendapatanproses,
            //         'pendapatantotal' => $pendapatantotal

        ];
        //     $this->load->view('templates/admin/header');
        //     $this->load->view('templates/admin/sidebar');
        //     $this->load->view('templates/admin/navbar');
        //     $this->load->view('admin/index', $data);
        //     $this->load->view('templates/admin/footer');
        // } else {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin/footer');
        // redirect('auth/login');
        // }
    }

    public function datacs()
    {
        $user = $this->User_model->selectadm(1);
        $data = [
            'user' => $user
        ];

        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/datacustomer', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    public function datadmin()
    {
        $outlet = $this->User_model->selectadm(2);
        $agen = $this->User_model->selectadm(4);

        $data = [
            'outlet' => $outlet,
            'agen' => $agen
        ];
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/dataadmin', $data);
            $this->load->view('templates/admin/footer');
        }
    }




    public function datapemesananagen()
    {
        $pemesanan = $this->Transaksi_model->selectAgen();
        $data = [
            'pemesanan' => $pemesanan
        ];
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/datapemesananagen', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    public function mp()
    {
        $datajemput = $this->Transaksi_model->selectwhere('Menunggu Penjemputan');
        $data = [
            'datajemput' => $datajemput
        ];
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/datamenunggupenjemputan', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    // public function pesanandiproses()
    // {
    //     $datajemput = $this->Transaksi_model->selectwhere('Pesanan Diproses');
    //     $data = [
    //         'datajemput' => $datajemput
    //     ];
    //     $ci = get_instance();
    //     if ($ci->session->userdata('id') != '8') {
    //         redirect('superadmin/');
    //     } else {
    //         $this->load->view('templates/admin/header');
    //         $this->load->view('templates/admin/sidebar');
    //         $this->load->view('templates/admin/navbar');
    //         $this->load->view('admin/datapesanandiproses', $data);
    //         $this->load->view('templates/admin/footer');
    //     }
    // }
    // public function pesanandiantar()
    // {
    //     $datajemput = $this->Transaksi_model->selectwhere('Pesanan Diantar');
    //     $data = [
    //         'datajemput' => $datajemput
    //     ];
    //     $ci = get_instance();
    //     if ($ci->session->userdata('id') != '8') {
    //         redirect('superadmin/');
    //     } else {
    //         $this->load->view('templates/admin/header');
    //         $this->load->view('templates/admin/sidebar');
    //         $this->load->view('templates/admin/navbar');
    //         $this->load->view('admin/datapesanandiantar', $data);
    //         $this->load->view('templates/admin/footer');
    //     }
    // }

    public function datatransaksi()
    {
        $pemesanan = $this->Transaksi_model->selecttransaksi();
        $data = [
            'pemesanan' => $pemesanan
        ];
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/datatransaksi', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    public function logout()
    {
        $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been logged out'));
        $this->session->unset_userdata('id');
        redirect('auth/login');
    }


    public function delete($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $users = $this->User_model->getUserById($id);
            $data = [
                'users' => $users
            ];

            // var_dump($users['fk_role']);
            // die;
            if ($users['fk_role'] == '1') {
                if ($id) {
                    if ($this->Transaksi_model->deleteUser($id) && $this->User_model->deleteUser($id) == true) {
                        $this->session->set_flashdata('message', $this->flasher('success', 'Success To Delete Data'));
                    } else {
                        $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Delete Data'));
                    }
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
                }

                redirect('superadmin/datacs');
            } else {
                if ($id) {
                    if ($this->User_model->deleteUser($id) == true && $this->Transaksi_model->deleteUser($id) == true) {
                        $this->session->set_flashdata('message', $this->flasher('success', 'Success To Delete Data'));
                    }
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
                }
                redirect('superadmin/datadmin');
            }
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

    public function updatepemesanan($id, $ubah)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $d = date("Y-m-d");
            $status = '';
            if ($ubah == '1') {
                $status = 'Pesanan Diproses';
            } elseif ($ubah == '2') {
                $status = 'Pesanan Diantar';
                $tgl_antar = $d;
            } else {
                $status = 'selesai';
                $tgl_antar = $d;
            }

            $db = [
                'status' => $status,
                'tgl_antar' => $tgl_antar
            ];

            $this->Transaksi_model->update($db, $id);
            redirect('superadmin/datapemesanan');
        }
    }

    public function laporan()
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
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
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/laporan', $data);
            $this->load->view('templates/admin/footer');
        }
    }
}
