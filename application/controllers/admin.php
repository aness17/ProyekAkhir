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
        // $this->load->model('Transaksi_model');
        // $this->load->library('Pdf');
        // $this->load->library('Excel');

        // if (empty($this->session->userdata('id'))) {
        //     redirect('auth/login');
        // }

    }
    public function index()
    {

        // $ci = get_instance();
        // if ($ci->session->userdata('id_role') == '2') {
        //     redirect('outlet/');
        // } elseif ($ci->session->userdata('id_role') == '4') {
        //     redirect('agen/');
        // } elseif ($ci->session->userdata('id_role') == '3') {


        //     $mp = $this->Transaksi_model->selectwhere('Menunggu Penjemputan');
        //     $datacs = $this->User_model->sumcs();
        //     $dataagen = $this->User_model->sumagen();
        //     $dataoutlet = $this->User_model->sumoutlet();
        //     $datajemput = $this->Transaksi_model->select('Menunggu Penjemputan');
        //     $dataproses = $this->Transaksi_model->select('Pesanan Diproses');
        //     $datadiantar = $this->Transaksi_model->select('Pesanan Diantar');
        //     $dataselesai = $this->Transaksi_model->select('selesai');
        //     $datatrans = $this->Transaksi_model->selecttrans();
        //     $pendapatan = $this->Transaksi_model->sumharga()[0]->harga;
        //     $pendapatanproses = $this->Transaksi_model->sumhargaproses()[0]->harga;
        //     $pendapatantotal = $this->Transaksi_model->sumhargatotal()[0]->harga;


        //     $data = [
        //         'datacs' => $datacs,
        //         'dataagen' => $dataagen,
        //         'dataoutlet' => $dataoutlet,
        //         'datajemput' => $datajemput,
        //         'dataproses' => $dataproses,
        //         'datadiantar' => $datadiantar,
        //         'dataselesai' => $dataselesai,
        //         'datatrans' => $datatrans,
        //         'mp' => $mp,
        //         'pendapatan' => $pendapatan,
        //         'pendapatanproses' => $pendapatanproses,
        //         'pendapatantotal' => $pendapatantotal

        //     ];
        //     $this->load->view('templates/admin/header');
        //     $this->load->view('templates/admin/sidebar');
        //     $this->load->view('templates/admin/navbar');
        //     $this->load->view('admin/index', $data);
        //     $this->load->view('templates/admin/footer');
        // } else {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/index');
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

    public function dataproduk()
    {
        $produk = $this->Produk_model->selectAll();
        // $jenis = $this->Jenis_model->selectAll();

        $data = [
            'produk' => $produk
            // 'jenis' => $jenis
        ];
        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        // $this->load->view('templates/admin/navbar');
        $this->load->view('admin/dataproduk', $data);
        $this->load->view('templates/admin/footer');
        // }
    }
    public function dataumkm()
    {
        $umkm = $this->Umkm_model->selectAll();
        $data = [
            'umkm' => $umkm
        ];

        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/dataumkm', $data);
        $this->load->view('templates/admin/footer');
        // }
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
    public function pesanandiproses()
    {
        $datajemput = $this->Transaksi_model->selectwhere('Pesanan Diproses');
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
            $this->load->view('admin/datapesanandiproses', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    public function pesanandiantar()
    {
        $datajemput = $this->Transaksi_model->selectwhere('Pesanan Diantar');
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
            $this->load->view('admin/datapesanandiantar', $data);
            $this->load->view('templates/admin/footer');
        }
    }

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
    public function add()
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email_cs]');
            $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('nohp', 'No Handphone', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('id_role', 'Role', 'required');

            if ($this->form_validation->run() == true) {
                $email = $this->input->post('email');
                $pos = strpos($email, "@gmail.com") ? "ada" : "tidak ada";
                if ($pos == "tidak ada") {
                    echo "<script>alert('harus gugel bund');history.go(-1);</script>";
                    $this->session->set_flashdata('message_login', $this->flasher('danger', 'HARUS AKUN GUGEL'));
                } else {
                    $db = [
                        'nama_cs' => $this->input->post('nama'),
                        'email_cs' => $this->input->post('email'),
                        'passwd_cs' => password_hash($this->input->post('passwd'), PASSWORD_DEFAULT),
                        'nohp_cs' => $this->input->post('nohp'),
                        'alamat_cs' => $this->input->post('alamat'),
                        'catatan' => 'input by superadmin',
                        'fk_role' => $this->input->post('id_role')
                    ];

                    // var_dump($db);

                    if ($this->User_model->createUser($db) > 0) {
                        $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                    } else {
                        $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                    }

                    if ($db['fk_role' == '1']) {
                        redirect('superadmin/datacs');
                    } else {
                        redirect('superadmin/datadmin');
                    }
                }
                redirect('superadmin/addadmin');
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('templates/admin/navbar');
                $this->load->view('admin/addadmin');
                $this->load->view('templates/admin/footer');
            }
        }
    }

    public function edit($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('nohp', 'No Handphone', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('id_role', 'Role', 'required');

            $users = $this->User_model->getUserById($id);
            $data = [
                'users' => $users
            ];
            if ($this->form_validation->run() == true) {

                $db = [
                    'id_cs' => $id,
                    'nama_cs' => $this->input->post('nama'),
                    'email_cs' => $this->input->post('email'),
                    'passwd_cs' => password_hash($this->input->post('passwd'), PASSWORD_DEFAULT),
                    'nohp_cs' => $this->input->post('nohp'),
                    'alamat_cs' => $this->input->post('alamat'),
                    'catatan' => 'input by superadmin',
                    'fk_role' => $this->input->post('id_role')
                ];

                if ($this->User_model->updateUser($db) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
                }

                if ($db['fk_role'] == '1') {
                    redirect('superadmin/datacs');
                } else {
                    redirect('superadmin/datadmin');
                }
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('templates/admin/navbar');
                $this->load->view('admin/edit', $data);
                $this->load->view('templates/admin/footer');
            }
        }
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
    public function addproduk()
    {
        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->form_validation->set_rules('namaproduk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('keteranganproduk', 'Keterangan Produk', 'required');
        $this->form_validation->set_rules('hargaproduk', 'Harga Produk', 'required');
        $this->form_validation->set_rules('stokproduk', 'Stok Produk', 'required');
        $this->form_validation->set_rules('fotoproduk', 'Foto Produk', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori Produk', 'required');
        $this->form_validation->set_rules('umkm', 'UMKM Produk', 'required');


        if ($this->form_validation->run() == true) {
            $db = [
                'nama_produk' => $this->input->post('namaproduk'),
                'keterangan_produk' => $this->input->post('keteranganproduk'),
                'harga_produk' => $this->input->post('hargaproduk'),
                'stok_produk' => $this->input->post('stokproduk'),
                'foto_produk' => $this->input->post('fotoproduk'),
                'fk_kategori' => $this->input->post('kategori'),
                'fk_umkm' => $this->input->post('umkm')
            ];

            // var_dump($db);

            if ($this->Produk_model->create($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }
            redirect('admin/dataproduk');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/tambahproduk');
            $this->load->view('templates/admin/footer');
        }
        // }
    }
    public function addlayanan()
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('estimasi', 'Estimasi Waktu', 'required');
            $this->form_validation->set_rules('harga', 'Harga', 'required');

            if ($this->form_validation->run() == true) {
                $db = [
                    'nama_layanan' => $this->input->post('nama'),
                    'estimasi_waktu_layanan' => $this->input->post('estimasi'),
                    'harga_layanan' => $this->input->post('harga')
                ];

                // var_dump($db);

                if ($this->Layanan_model->create($db) > 0) {
                    $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                } else {
                    $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                }
                redirect('superadmin/datalayanan');
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('templates/admin/navbar');
                $this->load->view('admin/layanan/add');
                $this->load->view('templates/admin/footer');
            }
        }
    }
    public function deletejenis($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            if ($id) {
                if ($this->Jenis_model->delete($id) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
                }
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
            }
            redirect('superadmin/datalayanan');
        }
    }
    public function deletelayanan($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            if ($id) {
                if ($this->Layanan_model->delete($id) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
                }
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
            }
            redirect('superadmin/datalayanan');
        }
    }

    public function editjenis($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('satuan', 'Satuan', 'required');
            $this->form_validation->set_rules('estimasi', 'Estimasi Waktu', 'required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
            $this->form_validation->set_rules('harga', 'Harga', 'required');

            $jenis = $this->Jenis_model->getUserById($id);
            $data = [
                'jenis' => $jenis
            ];
            // if ($id == "") {
            if ($this->form_validation->run() == true) {
                $db = [
                    'id_jenis' => $id,
                    'nama_jenis' => $this->input->post('nama'),
                    'satuan_jenis' => $this->input->post('satuan'),
                    'estimasi_waktu_jenis' => $this->input->post('estimasi'),
                    'keterangan' => $this->input->post('keterangan'),
                    'harga_jenis' => $this->input->post('harga')
                ];

                if ($this->Jenis_model->update($db) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
                }
                redirect('superadmin/datalayanan');
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('templates/admin/navbar');
                $this->load->view('admin/jenis/edit', $data);
                $this->load->view('templates/admin/footer');
            }
        }
    }
    public function editlayanan($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '8') {
            redirect('superadmin/');
        } else {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('estimasi', 'Estimasi Waktu', 'required');
            $this->form_validation->set_rules('harga', 'Harga', 'required');

            $layanan = $this->Layanan_model->getUserById($id);
            $data = [
                'layanan' => $layanan
            ];
            if ($this->form_validation->run() == true) {

                $db = [
                    'id_layanan' => $id,
                    'nama_layanan' => $this->input->post('nama'),
                    'estimasi_waktu_layanan' => $this->input->post('estimasi'),
                    'harga_layanan' => $this->input->post('harga')
                ];
                if ($this->Layanan_model->update($db) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
                }
                redirect('superadmin/datalayanan');
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('templates/admin/navbar');
                $this->load->view('admin/layanan/edit', $data);
                $this->load->view('templates/admin/footer');
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
