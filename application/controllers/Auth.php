<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Produk_model');

        // $this->load->model('Transaksi_model');
        // $this->load->model('Jenis_model');
        // $this->load->model('Layanan_model');
    }
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
    public function index()
    {
        $this->load->view('templates/user/header');
        $this->load->view('user/index');
        $this->load->view('templates/user/footer');
        // $ci = get_instance();
        // if ($ci->session->userdata('id_role') == '1') {
        //     redirect('superadmin/');
        // } elseif ($ci->session->userdata('id_role') == '4') {
        //     redirect('agen/');
        // } elseif ($ci->session->userdata('id_role') == '2') {
        //     redirect('outlet/');
        // } else {
        //     $this->load->view('templates/user/header2');
        //     $this->load->view('user/index');
        //     $this->load->view('templates/user/footer');
        // }
    }
    public function login()
    {
        $this->form_validation->set_rules('username', 'Username');
        $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[4]');

        $username = $this->input->post('username');
        $passwd = $this->input->post('passwd');

        $user = $this->db->get_where('pelanggan', ['username_pelanggan' => $username])->row_array();

        if ($this->form_validation->run()) {
            if (isset($user)) {
                // var_dump($user);
                // die;
                if (password_verify($passwd, $user['password_pelanggan'])) {
                    // var_dump($user);
                    // die;
                    $this->session->set_userdata('id', $user['id_pelanggan']);
                    $this->session->set_userdata('username', $user['username_pelanggan']);
                    $this->session->set_userdata('id_role', $user['fk_role']);
                    if ($user['fk_role'] == '1') {
                        echo "<script>location.href='" . base_url('admin') . "';alert('Anda Berhasil Masuk Sebagai Admin');</script>";
                        // echo "<script>location.href='" . base_url('auth/dashboard') . "';alert('Anda Berhasil Masuk');</script>";
                    } else if ($user['fk_role'] == '2') {
                        echo "<script>location.href='" . base_url('pemilik') . "';alert('Anda Berhasil Masuk Sebagai Owner');</script>";
                    } else {
                        echo "<script>location.href='" . base_url('auth/dashboard') . "';alert('Anda Berhasil Masuk Sebagai Customer');</script>";
                    }
                } else {
                    // var_dump($user);
                    // die;
                    echo "<script>location.href='" . base_url('auth/login') . "';alert('Password Salah');</script>";
                }
            } else {
                echo "<script>location.href='" . base_url('auth/login') . "';alert('User Tidak Ada');</script>";
            }
        } else {
            // var_dump($user);
            // die;
            $this->load->view('auth/login');
        }
    }

    public function register()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[pelanggan.username_pelanggan]');
        $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[6]');


        if ($this->form_validation->run()) {
            // $email = $this->input->post('email');
            // $pos = strpos($email, "@gmail.com") ? "ada" : "tidak ada";
            // if ($pos == "tidak ada") {
            //     echo "<script>alert('harus gugel bund');history.go(-1);</script>";
            //     $this->session->set_flashdata('message_login', $this->flasher('danger', 'HARUS AKUN GUGEL'));
            // } else {
            $db = [
                'nama_pelanggan' => $this->input->post('nama'),
                'username_pelanggan' => $this->input->post('username'),
                'password_pelanggan' => password_hash($this->input->post('passwd'), PASSWORD_DEFAULT),
                'fk_role' => '3'
            ];
            // var_dump($db);
            // die;
            if ($this->User_model->createpelanggan($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                echo "<script>location.href='" . base_url('auth/login') . "';alert('Daftar Berhasil');</script>";
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }
        } else {
            $this->load->view('auth/register');
            // echo "<script>location.href='" . base_url('login/formregister') . "';alert('Anda gagal Registrasi');</script>";
        }
    }

    public function logout()
    {
        $id = $this->session->userdata('id_role');
        if ($id == '1') {
            $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been logged out'));
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('id_role');
            $this->session->unset_userdata('nama');
            echo "<script>alert('Anda Telah Keluar');</script>";
            redirect('auth/');
        } else {
            $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been logged out'));
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('id_role');
            $this->session->unset_userdata('nama');
            echo "<script>alert('Anda Telah Keluar');</script>";
            redirect('auth/');
        }
    }

    public function dashboard()
    {
        $this->load->view('templates/user/header2');
        $this->load->view('user/dashboard');
        $this->load->view('templates/user/footer');
    }
    public function produk()
    {
        $produk = $this->Produk_model->selectAll();

        $data = [
            'produk' => $produk
        ];
        $this->load->view('templates/user/header');
        $this->load->view('user/produk', $data);
        $this->load->view('templates/user/footer');
    }
    // public function login_act()
    // {
    //     $this->load->view('user/login');
    // }
    // public function pesan()
    // {
    //     $ci = get_instance();
    //     if (!$ci->session->userdata('id')) {
    //         redirect('auth/login');
    //     } elseif ($ci->session->userdata('id') == '8'  || $ci->session->userdata('id_role') == '4' || $ci->session->userdata('id_role') == '2') {
    //         echo "Akses di blokir";
    //     } else {

    //         $this->form_validation->set_rules('jenis', 'Pilihan Laundry',  'required');
    //         if ($this->input->post('jenis') == 'kiloan') {
    //             $this->form_validation->set_rules('tgl_kiloan', 'Tanggal Penjemputan',  'required');
    //             $this->form_validation->set_rules('kiloan', 'Jasa',  'required');
    //             $layanan = $this->Layanan_model->getLayanan();
    //             $jenis = $this->Jenis_model->getJenis();

    //             $data = [
    //                 "layanan" => $layanan,
    //                 "jenis" => $jenis
    //             ];
    //             if ($this->form_validation->run() == true) {
    //                 $d = date("Y-m-d");
    //                 $type = $this->input->post('jenis');

    //                 $q = $this->Transaksi_model->selectAll();
    //                 foreach ($q as $r) {
    //                     if ($type == "kiloan") {
    //                         $db = [
    //                             'id_cs' => $this->session->userdata('id'),
    //                             'id_jenis' => 4,
    //                             'id_layanan' => $this->input->post('kiloan'),
    //                             'tgl_order' => $d,
    //                             'tgl_pickup' => $this->input->post('tgl_kiloan'),
    //                             'harga' => 0,
    //                             'status' => "Menunggu Penjemputan"
    //                         ];
    //                     } else {
    //                         $db = [
    //                             'id_cs' => $this->session->userdata('id'),
    //                             'id_jenis' => $this->input->post('satuan'),
    //                             'id_layanan' => 2,
    //                             'tgl_order' => $d,
    //                             'tgl_pickup' => $this->input->post('tgl_satuan'),
    //                             'ket_jumlah' => $this->input->post('jumlah'),
    //                             'harga' => $r['harga_jenis'] * $this->input->post('jumlah'),
    //                             'status' => "Menunggu Penjemputan"
    //                         ];
    //                     }
    //                 }
    //                 if ($this->Transaksi_model->createPesanan($db) > 0) {
    //                     $this->session->set_flashdata('message', $this->flasher('success', 'Pesanan anda telah berhasil'));
    //                     echo "berhasil";
    //                     redirect('auth/detail_pemesanan');
    //                 } else {
    //                     echo "gagal";
    //                     $this->session->set_flashdata('message', $this->flasher('danger', 'Pesanan anda gagal'));
    //                     redirect('auth/pesan');
    //                 }
    //             } else {

    //                 $this->load->view('templates/user/header');
    //                 $this->load->view('user/pesan', $data);
    //                 $this->load->view('templates/user/footer2');
    //             }
    //         } else {
    //             $this->form_validation->set_rules('tgl_satuan', 'Tanggal Penjemputan',  'required');
    //             $this->form_validation->set_rules('jumlah', 'Jumlah',  'required');

    //             $layanan = $this->Layanan_model->getLayanan();
    //             $jenis = $this->Jenis_model->getJenis();

    //             $data = [
    //                 "layanan" => $layanan,
    //                 "jenis" => $jenis
    //             ];
    //             if ($this->form_validation->run() == true) {
    //                 $d = date("Y-m-d");
    //                 $type = $this->input->post('jenis');

    //                 $q = $this->Transaksi_model->selectAll();
    //                 foreach ($q as $r) {
    //                     if ($type == "kiloan") {
    //                         $db = [
    //                             'id_cs' => $this->session->userdata('id'),
    //                             'id_jenis' => 4,
    //                             'id_layanan' => $this->input->post('kiloan'),
    //                             'tgl_order' => $d,
    //                             'tgl_pickup' => $this->input->post('tgl_kiloan'),
    //                             'harga' => 0,
    //                             'status' => "Menunggu Penjemputan"
    //                         ];
    //                     } else {
    //                         $db = [
    //                             'id_cs' => $this->session->userdata('id'),
    //                             'id_jenis' => $this->input->post('satuan'),
    //                             'id_layanan' => 2,
    //                             'tgl_order' => $d,
    //                             'tgl_pickup' => $this->input->post('tgl_satuan'),
    //                             'ket_jumlah' => $this->input->post('jumlah'),
    //                             'harga' => $r['harga_jenis'] * $this->input->post('jumlah'),
    //                             'status' => "Menunggu Penjemputan"
    //                         ];
    //                     }
    //                 }
    //                 if ($this->Transaksi_model->createPesanan($db) > 0) {
    //                     echo "<script>location.href='" . base_url('auth.hasil_pesanan') . "';alert('Anda Berhasil Masuk Sebagai Admin');</script>";
    //                     $this->session->set_flashdata('message', $this->flasher('success', 'Pesanan anda telah berhasil'));
    //                     echo "berhasil";
    //                     redirect('auth/detail_pemesanan');
    //                 } else {
    //                     echo "gagal";
    //                     $this->session->set_flashdata('message', $this->flasher('danger', 'Pesanan anda gagal'));
    //                     redirect('auth/pesan');
    //                 }
    //             } else {
    //                 //$this->load->view('templates/user/header');
    //                 $this->load->view('templates/user/header');
    //                 $this->load->view('user/pesan', $data);
    //                 $this->load->view('templates/user/footer2');
    //             }
    //         }
    //     }
    // }
    // public function hasil_pesanan()
    // {
    //     $ci = get_instance();
    //     if (!$ci->session->userdata('id')) {
    //         redirect('auth/login');
    //     } elseif ($ci->session->userdata('id') == '8'  || $ci->session->userdata('id_role') == '4' || $ci->session->userdata('id_role') == '2') {
    //         echo "Akses di blokir";
    //     } else {
    //         $id = $this->session->userdata('id');
    //         $user = $this->Transaksi_model->selecthasil($id);

    //         $data = [
    //             'user' => $user
    //         ];

    //         $this->load->view('templates/user/header');
    //         $this->load->view('user/hasil_pesanan', $data);
    //         $this->load->view('templates/user/footer2');
    //     }
    // }
    // public function detail_pemesanan()
    // {
    //     $ci = get_instance();
    //     if (!$ci->session->userdata('id')) {
    //         redirect('auth/login');
    //     } elseif ($ci->session->userdata('id') == '8' || $ci->session->userdata('id_role') == '4' || $ci->session->userdata('id_role') == '2') {
    //         echo "Akses di blokir";
    //     } else {
    //         $id = $this->session->userdata('id');
    //         $user = $this->Transaksi_model->struk($id);

    //         $data = [
    //             'user' => $user
    //         ];
    //         $this->load->view('templates/user/header');
    //         $this->load->view('user/detail_pemesanan', $data);
    //         $this->load->view('templates/user/footer2');
    //     }
    // }



    // public function profil()
    // {

    //     $ci = get_instance();
    //     if (!$ci->session->userdata('id')) {
    //         redirect('auth/login');
    //     } elseif ($ci->session->userdata('id') == '8' || $ci->session->userdata('id_role') == '4' || $ci->session->userdata('id_role') == '2') {
    //         echo "Akses di blokir";
    //     } else {
    //         $id = $this->session->userdata('id');
    //         $users = $this->User_model->getUserById($id);
    //         $data = [
    //             'users' => $users
    //         ];
    //         $this->load->view('templates/user/header');
    //         $this->load->view('user/profile', $data);
    //         $this->load->view('templates/user/footer2');
    //     }
    // }


    // public function editprofil($id)
    // {
    //     $ci = get_instance();
    //     if (!$ci->session->userdata('id')) {
    //         redirect('auth/login');
    //     } elseif ($ci->session->userdata('id') == '8'  || $ci->session->userdata('id_role') == '4' || $ci->session->userdata('id_role') == '2') {
    //         echo "Akses di blokir";
    //     } else {
    //         $this->form_validation->set_rules('nama', 'Nama', 'required');
    //         $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    //         $this->form_validation->set_rules('nohp', 'No Hp', 'required');

    //         $users = $this->User_model->getUserById($id);
    //         $data = [
    //             'users' => $users
    //         ];

    //         if ($this->form_validation->run() == true) {
    //             $db = [

    //                 'nama_cs' => $this->input->post('nama'),
    //                 'nohp_cs' => $this->input->post('nohp'),
    //                 'alamat_cs' => $this->input->post('alamat')
    //             ];

    //             if ($this->User_model->update($db, $id) > 0) {
    //                 $this->session->set_flashdata('message', $this->flasher('success', 'Profil Anda telah diperbarui'));
    //                 echo "berhasil";
    //                 redirect('auth/profil');
    //             } else {
    //                 echo "gagal";
    //                 $this->session->set_flashdata('message', $this->flasher('danger', 'Profil Anda gagal diperbarui'));
    //                 redirect('auth/editprofile');
    //             }
    //         } else {
    //             $this->load->view('templates/user/header');
    //             $this->load->view('user/editprofile', $data);
    //             $this->load->view('templates/user/footer2');
    //         }
    //     }
    // }

    // public function dashboard()
    // {
    //     $ci = get_instance();
    //     $id = $this->session->userdata('id');
    //     if (!$ci->session->userdata('id')) {

    //         $this->load->view('templates/user/header2');
    //         $this->load->view('user/dashboard');
    //         $this->load->view('templates/user/footer');
    //     } elseif ($ci->session->userdata('id') == '8' || $ci->session->userdata('id_role') == '4' || $ci->session->userdata('outlet') == '2') {
    //         echo "Anda login menggunakan akun " . $this->session->userdata('nama') . ". Anda akan dialihkan ke halaman " . $this->session->userdata('nama');

    //         if ($this->session->userdata('nama') == 'admin') {
    //             redirect('superadmin/');
    //         } elseif ($this->session->userdata('id_role') == '4') {
    //             redirect('agen/');
    //         } elseif ($this->session->userdata('id_role') == '2') {
    //             redirect('outlet/');
    //         }
    //     } else {
    //         $this->load->view('templates/user/header');
    //         $this->load->view('user/dashboard');
    //         $this->load->view('templates/user/footer2');
    //     }
    // }

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
}
