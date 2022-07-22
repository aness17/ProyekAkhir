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
            $data["bestSeller"] = $this->DetailTransaksi_model->bestSeller();
            if ($this->session->userdata('id_role') == 3) {
                $this->load->view('templates/user/header2', $data);
            } else {
                $this->load->view('templates/user/header', $data);
            }
            $this->load->view('user/index', $data);
            $this->load->view('templates/user/footer');
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
                        echo "<script>location.href='" . base_url('auth') . "';alert('Anda Berhasil Masuk Sebagai Customer');</script>";
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
        $data_item = [];
        foreach ($transaksi as $t) {
            array_push($data_item, ["id" => $t["id_transaksi"], "item" => $t["nama_produk"]]);
        };

        $data = [
            'detail' => $detail,
            "produk" => $produk
        ];
        if ($this->input->get("search")) {
            $apriori = new apriori();
            $rekom = $apriori->main($data_item);
            $rekomendasi = [];
            foreach ($rekom as $r) {
                if ($r["item"] == $detail["nama_produk"]) {
                    array_push($rekomendasi, $this->Produk_model->getWhere(["nama_produk" => $r["val"]]));
                }
            }
            $data["rekomendasi"] = $rekomendasi;
        }
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
            $keranjang = $this->Keranjang_model->selectAll();
            $data["produk"] = $this->Produk_model->selectAll();


            if ($this->session->userdata('id_role') == 3) {
                $this->load->view('templates/user/header2', $data);
            } else {
                $this->load->view('templates/user/header', $data);
            }

            $data = [
                'keranjang' => $keranjang
            ];

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
            echo "<script>location.href='" . base_url('auth/riwayat') . "';alert('Anda telah berhasil lalamengcheckout keranjang');</script>";
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
class apriori
{
    function main($data_item)
    {
        $minSupport = 11;
        $minConvident = 60;
        $arr = [];
        for ($i = 0; $i < count($data_item); $i++) {
            $ar = [];
            $val = explode(",", $data_item[$i]["item"]);
            for ($j = 0; $j < count($val); $j++) {
                $ar[] = $val[$j];
            }
            array_push($arr, $ar);
        }

        $frekuensi_item = $this->frekuensiItem($arr);
        $dataEliminasi = $this->eliminasiItem($frekuensi_item, $minSupport);

        // print_r($dataEliminasi);

        do {
            $pasangan_item = $this->pasanganItem($dataEliminasi);
            $frekuensi_item = $this->FrekuensiPasanganItem($pasangan_item, $arr);
            $dataEliminasi = $this->eliminasiItem($frekuensi_item, $minSupport);
            foreach ($frekuensi_item as $key => $val) {

                $ex = explode("_", $key);
                $item = "";
                $vl = "";
                for ($k = 0; $k < count($ex); $k++) {
                    if ($k !== count($ex) - 1) {
                        $item .= "," . $ex[$k];
                    } else {
                        $vl = $ex[$k];
                    }
                }
                $aturan_asosiasi[] = array("item" => substr($item, 1), "val" => $vl, "sc" => $val);
            }
        } while ($dataEliminasi == $frekuensi_item);


        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
            $x = 0;

            $ex = explode(",", $aturan_asosiasi[$i]["item"]);

            for ($l = 0; $l < count($arr); $l++) {
                $jum = 0;
                for ($k = 0; $k < count($ex); $k++) {

                    for ($j = 0; $j < count($arr[$l]); $j++) {
                        if ($arr[$l][$j] == $ex[$k]) {
                            $jum += 1;
                        }
                    }
                }
                if (count($ex) == $jum) {
                    $x += 1;
                }
            }
            $convident = (floatval($aturan_asosiasi[$i]["sc"]) / floatval($x)) * 100;
            if ($convident >= $minConvident) {
                $aturan_asosiasi[$i]["c"] = number_format($convident, 2, ".", ",");
            }
            return $aturan_asosiasi;
            var_dump($aturan_asosiasi);
            die;
        }
        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
            if ($aturan_asosiasi[$i]["c"] == 0) {
                array_splice($aturan_asosiasi, $i--, 1);
            }
            return $aturan_asosiasi;
        }
        return $aturan_asosiasi;
    }

    function frekuensiItem($data)
    {
        $arr = [];
        for ($i = 0; $i < count($data); $i++) {
            $jum = array_count_values($data[$i]);
            foreach ($jum as $key => $v) {
                if (array_key_exists($key, $arr)) {
                    $arr[$key] += 1;
                } else {
                    $arr[$key] = 1;
                }
            }
        }
        return $arr;
    }

    function eliminasiItem($data, $minSupport)
    {
        $arr = [];
        foreach ($data as $key => $v) {
            if ($v >= $minSupport) {
                $arr[$key] = $v;
            }
        }
        return $arr;
    }
    function pasanganItem($data_filter)
    {
        $n = 0;
        $arr = [];
        foreach ($data_filter as $key1 => $v1) {
            $m = 1;
            foreach ($data_filter as $key2 => $v2) {
                $str = explode("_", $key2);
                for ($i = 0; $i < count($str); $i++) {

                    if (!strstr($key1, $str[$i])) {
                        if ($m > $n + 1 && count($data_filter) > $n + 1) {
                            $arr[$key1 . "_" . $str[$i]] = 0;
                        }
                    }
                }
                $m++;
            }
            $n++;
        }
        return $arr;
    }

    function frekuensiPasanganItem($data_pasangan, $data)
    {
        $arr = $data_pasangan;
        $ky = "";
        $kali = 0;
        foreach ($data_pasangan as $key1 => $k) {
            for ($i = 0; $i < count($data); $i++) {
                $kk = explode("_", $key1);
                $jm = 0;
                for ($k = 0; $k < count($kk); $k++) {

                    for ($j = 0; $j < count($data[$i]); $j++) {
                        if ($data[$i][$j] == $kk[$k]) {
                            $jm += 1;
                            break;
                        }
                    }
                }
                if ($jm > count($kk) - 1) {
                    $arr[$key1] += 1;
                }
            }
        }
        return $arr;
    }
}
