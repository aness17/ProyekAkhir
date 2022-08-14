<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Produk_model');
        $this->load->model('Keranjang_model');
        $this->load->model('Transaksi_model');
        $this->load->model('DetailTransaksi_model');
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
        $ci = get_instance();
        if ($ci->session->userdata('id_role') == '1') {
            redirect('admin/');
        } elseif ($ci->session->userdata('id_role') == '2') {
            redirect('pemilik/');
        } else {
            $data["produk"] = $this->Produk_model->selectAll();
            $data["bestSeller"] = $this->DetailTransaksi_model->bestSeller(date('m'));
            if ($this->session->userdata('id_role') == 3) {
                $this->load->view('templates/user/header2', $data);
            } else {
                $this->load->view('templates/user/header', $data);
            }
            $this->load->view('user/index', $data);
            $this->load->view('templates/user/footer');
        }
    }
    public function loginviera()
    {
        $this->form_validation->set_rules('username', 'Username');
        $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[4]');

        $username = $this->input->post('username');
        $passwd = $this->input->post('passwd');

        $user = $this->db->get_where('pelanggan', ['username_pelanggan' => $username])->row_array();

        if ($this->form_validation->run()) {
            if (isset($user)) {
                if (password_verify($passwd, $user['password_pelanggan'])) {
                    $this->session->set_userdata('id', $user['id_pelanggan']);
                    $this->session->set_userdata('username', $user['username_pelanggan']);
                    $this->session->set_userdata('id_role', $user['fk_role']);
                    if ($user['fk_role'] == '1') {
                        echo "<script>location.href='" . base_url('admin') . "';alert('Anda Berhasil Masuk Sebagai Admin');</script>";
                    } else if ($user['fk_role'] == '2') {
                        echo "<script>location.href='" . base_url('pemilik') . "';alert('Anda Berhasil Masuk Sebagai Owner');</script>";
                    }
                } else {
                    // var_dump($user);
                    // die;
                    echo "<script>location.href='" . base_url('auth/loginviera') . "';alert('Password Salah');</script>";
                }
            } else {
                echo "<script>location.href='" . base_url('auth/loginviera') . "';alert('User Tidak Ada');</script>";
            }
        } else {
            // var_dump($user);
            // die;
            $this->load->view('auth/loginviera');
        }
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
                if (password_verify($passwd, $user['password_pelanggan'])) {
                    $this->session->set_userdata('id', $user['id_pelanggan']);
                    $this->session->set_userdata('username', $user['username_pelanggan']);
                    $this->session->set_userdata('id_role', $user['fk_role']);
                    if ($user['fk_role'] == '3') {
                        echo "<script>location.href='" . base_url('auth') . "';alert('Anda Berhasil Masuk Sebagai Customer');</script>";
                    } else {
                        echo "<script>location.href='" . base_url('auth/login') . "';alert('User Tidak Ada');</script>";
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
            $this->session->unset_userdata('id_pelanggan');
            $this->session->unset_userdata('id_role');
            $this->session->unset_userdata('nama_pelanggan');
            echo "<script>alert('Anda Telah Keluar');</script>";
            redirect('auth/');
        } else {
            $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been logged out'));
            $this->session->unset_userdata('id_pelanggan');
            $this->session->unset_userdata('id_role');
            $this->session->unset_userdata('nama_pelanggan');
            echo "<script>alert('Anda Telah Keluar');</script>";
            redirect('auth/');
        }
    }

    public function profil()
    {
        $id = $this->session->userdata('id');

        $pelanggan = $this->User_model->getpelangganById($id);
        $data = [
            'pelanggan' => $pelanggan
        ];

        $data["produk"] = $this->Produk_model->selectAll();
        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/profil', $data);
        $this->load->view('templates/user/footer');
    }
    public function edit_profil($id)
    {
        $pelanggan = $this->User_model->getpelangganById($id);
        $data = [
            'pelanggan' => $pelanggan
        ];
        $this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('nohp', 'No. Telp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == true) {
            $db = [

                'nama_pelanggan' => $this->input->post('nama'),
                'nohp_pelanggan' => $this->input->post('nohp'),
                'alamat_pelanggan' => $this->input->post('alamat')
            ];

            if ($this->User_model->update($db, $id) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Profil Anda telah diperbarui'));
                echo "berhasil";
                redirect('auth/profil', $data);
            } else {
                echo "gagal";
                $this->session->set_flashdata('message', $this->flasher('danger', 'Profil Anda gagal diperbarui'));
                redirect('auth/edit_profil', $data);
            }
        } else {
            $data["produk"] = $this->Produk_model->selectAll();
            if ($this->session->userdata('id_role') == 3) {
                $this->load->view('templates/user/header2', $data);
            } else {
                $this->load->view('templates/user/header', $data);
            }
            $this->load->view('user/edit_profil', $data);
            $this->load->view('templates/user/footer');
        }
    }

    public function produk($kategori = "")
    {
        $kat = urldecode($kategori);

        if ($kategori == "") {
            $produk = $this->Produk_model->selectAll();
        } else {
            $produk = $this->Produk_model->selectproduk($kat);
        }
        if ($this->input->post()) {
            $harga = $this->input->post('harga');
            $harga2 = $this->input->post('harga2');

            $produk = $this->Produk_model->selectharga($harga, $harga2);
        }

        $data = [
            'produk' => $produk
        ];

        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/produk', $data);
        $this->load->view('templates/user/footer');
    }

    public function deskripsi_produk($id)
    {
        $detail = $this->Produk_model->getProdukById($id);
        $produk = $this->Produk_model->selectAll();
        $transaksi = $this->Transaksi_model->selectAll();
        $data = [
            'detail' => $detail,
            "produk" => $produk
        ];
        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/deskripsi_produk', $data);
        $this->load->view('templates/user/footer');
    }

    public function keranjang()
    {
        $data["produk"] = $this->Produk_model->selectAll();

        $ci = get_instance();
        if (!$ci->session->userdata('id')) {
            redirect('auth/login');
        } elseif ($ci->session->userdata('id') == '1'  || $ci->session->userdata('id_role') == '2') {
            echo "Akses di blokir";
        } else {
            $transaksi = $this->Transaksi_model->selectAll();
            $keranjang = $this->Keranjang_model->selectAll();

            $data_item = [];
            foreach ($transaksi as $t) {
                array_push($data_item, ["id" => $t["id_transaksi"], "item" => $t["nama_produk"]]);
            };

            $this->load->library('customautoloader');

            $apriori = new helpers\apriori();
            $rekom = $apriori->main($data_item);
            $cart = [];

            foreach ($keranjang as $k) {
                $rekomendasi = [];
                foreach ($rekom as $r) {
                    if ($r["item"] == $k["nama_produk"]) {
                        array_push($rekomendasi, $this->Produk_model->getWhere(["nama_produk" => $r["val"]]));
                    }
                }
                $k["rekomendasi"] = $rekomendasi;
                array_push($cart, $k);
            }
            // echo "<pre>";
            // print_r($cart);
            // echo "</pre>";
            // die;
            $produk = $this->Produk_model->selectAll();

            $data = [
                'keranjang' => $cart,
                'produk' => $produk
            ];

            if ($this->session->userdata('id_role') == 3) {
                $this->load->view('templates/user/header2', $data);
            } else {
                $this->load->view('templates/user/header', $data);
            }
            $this->load->view('user/keranjang', $data);
            $this->load->view('templates/user/footer');
        }
    }

    public function tambah_keranjang()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('id')) {
            redirect('auth/login');
        } elseif ($ci->session->userdata('id') == '1'  || $ci->session->userdata('id_role') == '2') {
            echo "Akses di blokir";
        } else {
            $data = [
                "id_produk" => $this->input->post("id"),
                "ket_jumlah" => $this->input->post("jumlah"),
                "id_pelanggan" => $this->session->userdata('id')
            ];
            $this->Keranjang_model->create($data);
            echo "<script>location.href='" . base_url('auth/produk') . "';alert('Anda telah berhasil memasukkan produk ke keranjang');</script>";
        }
    }

    public function ubah_keranjang()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('id')) {
            redirect('auth/login');
        } elseif ($ci->session->userdata('id') == '1'  || $ci->session->userdata('id_role') == '2') {
            echo "Akses di blokir";
        } else {
            $jumlah = $this->input->post("jumlah");
            $id = $this->input->post("id");
            if ($jumlah > 0) {
                $data = [
                    "id_keranjang" => $id,
                    "ket_jumlah" => $jumlah,
                ];
                $this->Keranjang_model->update($data);
                echo "<script>location.href='" . base_url('auth/keranjang') . "';alert('Anda telah berhasil mengubah produk di keranjang');</script>";
            } else {
                $this->Keranjang_model->delete($id);
                echo "<script>location.href='" . base_url('auth/keranjang') . "';alert('Anda telah berhasil menghapus produk di keranjang');</script>";
            }
        }
    }

    public function checkout()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('id')) {
            redirect('auth/login');
        } elseif ($ci->session->userdata('id') == '1'  || $ci->session->userdata('id_role') == '2') {
            echo "Akses di blokir";
        } else {
            $keranjang = $this->Keranjang_model->selectAll();
            $total = 0;
            foreach ($keranjang as $k) {
                $total += intval($k["ket_jumlah"] * $k['harga_produk']);
            }
            $data = [
                'id_pelanggan' => $this->session->userdata('id'),
                'total_harga' => $total,
                'status' => "Diproses"
            ];
            $this->Transaksi_model->createPesanan($data);

            $id = $this->Transaksi_model->getLastId()["id_transaksi"];
            foreach ($keranjang as $k) {
                $id_produk = $k["id_produk"];
                $data = [
                    'id_transaksi' => $id,
                    'id_produk' => $id_produk,
                    'ket_jumlah' => $k["ket_jumlah"],
                ];
                $this->DetailTransaksi_model->create($data);

                $p = $this->Produk_model->getProdukById($id_produk);
                $data = [
                    "id_produk" => $id_produk,
                    "stok_produk" => intval($p["stok_produk"]) - $k["ket_jumlah"]
                ];
                $this->Produk_model->update($data);

                $this->Keranjang_model->delete($k["id_keranjang"]);
            }
            echo "<script>location.href='" . base_url('auth/riwayat') . "';alert('Anda telah berhasil mengcheckout keranjang');</script>";
        }
    }

    public function riwayat()
    {

        $ci = get_instance();
        if (!$ci->session->userdata('id')) {
            redirect('auth/login');
        } elseif ($ci->session->userdata('id') == '1'  || $ci->session->userdata('id_role') == '2') {
            echo "Akses di blokir";
        } else {
            $riwayat = $this->DetailTransaksi_model->riwayat();
            $data["produk"] = $this->Produk_model->selectAll();

            $this->load->view('templates/user/header2', $data);

            $data = [
                'riwayat' => $riwayat
            ];

            $this->load->view('user/riwayat_pesanan', $data);
            $this->load->view('templates/user/footer');
        }
    }
    public function alamat()
    {
        $data["produk"] = $this->Produk_model->selectAll();

        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/alamat');
        $this->load->view('templates/user/footer');
    }
    public function tentang()
    {
        $data["produk"] = $this->Produk_model->selectAll();

        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/tentang');
        $this->load->view('templates/user/footer');
    }

    public function muri()
    {
        $data["produk"] = $this->Produk_model->selectAll();

        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/penghargaan_muri');
        $this->load->view('templates/user/footer');
    }
    public function dinaspariwisata()
    {
        $data["produk"] = $this->Produk_model->selectAll();

        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/dinas_pariwisata');
        $this->load->view('templates/user/footer');
    }
    public function juara2()
    {
        $data["produk"] = $this->Produk_model->selectAll();

        if ($this->session->userdata('id_role') == 3) {
            $this->load->view('templates/user/header2', $data);
        } else {
            $this->load->view('templates/user/header', $data);
        }
        $this->load->view('user/juara2');
        $this->load->view('templates/user/footer');
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
}
