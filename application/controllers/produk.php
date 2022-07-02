 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Produk extends CI_Controller
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

            $this->load->model('Produk_model');

            // $this->load->model('Transaksi_model');
            // $this->load->library('Pdf');
            // $this->load->library('Excel');

            if (empty($this->session->userdata('id'))) {
                redirect('auth/login');
            }
        }

        public function dataproduk()
        {
            $ci = get_instance();
            if ($ci->session->userdata('id') != '1') {
                redirect('superadmin/');
            } else {
                $produk = $this->Produk_model->selectAll();

                $data = [
                    'produk' => $produk
                ];
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('admin/produk/dataproduk', $data);
                $this->load->view('templates/admin/footer');
            }
        }
        public function dataprodukterpilih($kategori)
        {
            $ci = get_instance();
            if ($ci->session->userdata('id') != '1') {
                redirect('superadmin/');
            } else {
                $produk = $this->Produk_model->selectproduk($kategori);

                $data = [
                    'produk' => $produk
                ];
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('admin/produk/dataproduk', $data);
                $this->load->view('templates/admin/footer');
            }
        }
        public function addproduk()
        {
            $ci = get_instance();
            if ($ci->session->userdata('id') != '1') {
                redirect('superadmin/');
            } else {
                $this->form_validation->set_rules('namaproduk', 'Nama Produk', 'required');
                $this->form_validation->set_rules('keteranganproduk', 'Keterangan Produk', 'required');
                $this->form_validation->set_rules('hargaproduk', 'Harga Produk', 'required');
                $this->form_validation->set_rules('stokproduk', 'Stok Produk', 'required');
                // $this->form_validation->set_rules('fotoproduk', 'Foto Produk', 'required');
                $this->form_validation->set_rules('kategori', 'Kategori Produk', 'required');
                $this->form_validation->set_rules('umkm', 'UMKM Produk', 'required');


                if ($this->form_validation->run() == true) {
                    $config['upload_path']          = './produk/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1000;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('fotoproduk')) {
                        $last = explode("V", $this->Produk_model->getLastId()["id_produk"])[1];
                        $db = [
                            'id_produk' => 'RKV' . str_pad(intval($last) + 1, 3, '0', STR_PAD_LEFT),
                            'nama_produk' => $this->input->post('namaproduk'),
                            'keterangan_produk' => $this->input->post('keteranganproduk'),
                            'harga_produk' => $this->input->post('hargaproduk'),
                            'stok_produk' => $this->input->post('stokproduk'),
                            'foto_produk' => $this->upload->data()["file_name"],
                            'fk_kategori' => $this->input->post('kategori'),
                            'fk_umkm' => $this->input->post('umkm')
                        ];

                        // var_dump($db);

                        if ($this->Produk_model->create($db) > 0) {
                            $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                        } else {
                            $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                        }
                        redirect('produk/dataproduk');
                    } else {
                        $this->session->set_flashdata('message_login', $this->flasher('danger', $this->upload->display_errors()));
                        redirect('produk/dataproduk');
                    }
                } else {
                    $this->load->view('templates/admin/header');
                    $this->load->view('templates/admin/sidebar');
                    $this->load->view('admin/produk/tambahproduk');
                    $this->load->view('templates/admin/footer');
                }
            }
        }
        public function edit($id)
        {
            $ci = get_instance();
            if ($ci->session->userdata('id') != '1') {
                redirect('superadmin/');
            } else {
                $produk = $this->Produk_model->getProdukById($id);
                $this->form_validation->set_rules('namaproduk', 'Nama Produk', 'required');
                $this->form_validation->set_rules('keteranganproduk', 'Keterangan Produk', 'required');
                $this->form_validation->set_rules('hargaproduk', 'Harga Produk', 'required');
                $this->form_validation->set_rules('stokproduk', 'Stok Produk', 'required');
                // $this->form_validation->set_rules('fotoproduk', 'Foto Produk', 'required');
                $this->form_validation->set_rules('kategori', 'Kategori Produk', 'required');
                $this->form_validation->set_rules('umkm', 'UMKM Produk', 'required');


                if ($this->form_validation->run() == true) {
                    $db = [
                        'id_produk' => $id,
                        'nama_produk' => $this->input->post('namaproduk'),
                        'keterangan_produk' => $this->input->post('keteranganproduk'),
                        'harga_produk' => $this->input->post('hargaproduk'),
                        'stok_produk' => $this->input->post('stokproduk'),
                        'fk_kategori' => $this->input->post('kategori'),
                        'fk_umkm' => $this->input->post('umkm')
                    ];
                    if ($_FILES["fotoproduk"]["name"] != "") {
                        $config['upload_path']          = './produk/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 1000;

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('fotoproduk')) {
                            unlink(FCPATH . 'produk/' . $produk["foto_produk"]);
                            $db['foto_produk'] = $this->upload->data()["file_name"];
                        } else {
                            $this->session->set_flashdata('message_login', $this->flasher('danger', $this->upload->display_errors()));
                            var_dump($this->upload->display_errors());
                            die;
                            redirect('produk/edit/' . $id);
                        }
                    }
                    if ($this->Produk_model->update($db) > 0) {
                        $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                    } else {
                        $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                    }
                    redirect('produk/dataproduk');
                } else {
                    $this->load->view('templates/admin/header');
                    $this->load->view('templates/admin/sidebar');
                    $this->load->view('admin/produk/editproduk', ["produk" => $produk]);
                    $this->load->view('templates/admin/footer');
                }
            }
        }
        public function delete($id)
        {
            $ci = get_instance();
            if ($ci->session->userdata('nama') == "admin" || $ci->session->userdata('id_role') != '1' || $ci->session->userdata('id_role') == '2' || $ci->session->userdata('id_role') == '3') {
                echo ("Akses diblok");
            } else {
                if ($id) {
                    $produk = $this->Produk_model->getUserById($id);

                    unlink(FCPATH . 'produk/' . $produk["foto_produk"]);

                    if ($this->Produk_model->delete($id) > 0) {
                        $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
                    } else {
                        $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
                    }
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
                }
                redirect('produk/dataproduk');
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
    }
