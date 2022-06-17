 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Transaksi extends CI_Controller
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

            $this->load->model('Transaksi_model');

            // $this->load->model('Transaksi_model');
            // $this->load->library('Pdf');
            // $this->load->library('Excel');

            // if (empty($this->session->userdata('id'))) {
            //     redirect('auth/login');
            // }

        }
        public function datatransaksi()
        {
            $trans = $this->Transaksi_model->selectAll();
            // $jenis = $this->Jenis_model->selectAll();

            $data = [
                'trans' => $trans
                // 'jenis' => $jenis
            ];
            // $ci = get_instance();
            // if ($ci->session->userdata('id') != '8') {
            // redirect('superadmin/');
            // } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            // $this->load->view('templates/admin/navbar');
            $this->load->view('admin/transaksi/datatransaksi', $data);
            $this->load->view('templates/admin/footer');
            // }
        }
        public function addtransaksi()
        {
            // $ci = get_instance();
            // if ($ci->session->userdata('id') != '8') {
            //     redirect('superadmin/');
            // } else {
            $this->form_validation->set_rules('namatransaksi', 'Nama transaksi', 'required');
            $this->form_validation->set_rules('keterangantransaksi', 'Keterangan transaksi', 'required');
            $this->form_validation->set_rules('hargatransaksi', 'Harga transaksi', 'required');
            $this->form_validation->set_rules('stoktransaksi', 'Stok transaksi', 'required');
            // $this->form_validation->set_rules('fototransaksi', 'Foto transaksi', 'required');
            $this->form_validation->set_rules('kategori', 'Kategori transaksi', 'required');
            $this->form_validation->set_rules('umkm', 'UMKM transaksi', 'required');


            if ($this->form_validation->run() == true) {
                $config['upload_path']          = './transaksi/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fototransaksi')) {
                    $db = [
                        'nama_transaksi' => $this->input->post('namatransaksi'),
                        'keterangan_transaksi' => $this->input->post('keterangantransaksi'),
                        'harga_transaksi' => $this->input->post('hargatransaksi'),
                        'stok_transaksi' => $this->input->post('stoktransaksi'),
                        'foto_transaksi' => $this->upload->data()["file_name"],
                        'fk_kategori' => $this->input->post('kategori'),
                        'fk_umkm' => $this->input->post('umkm')
                    ];

                    // var_dump($db);

                    if ($this->transaksi_model->create($db) > 0) {
                        $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                    } else {
                        $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                    }
                    redirect('transaksi/datatransaksi');
                } else {
                    $this->session->set_flashdata('message_login', $this->flasher('danger', $this->upload->display_errors()));
                    redirect('transaksi/datatransaksi');
                }
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('admin/transaksi/tambahtransaksi');
                $this->load->view('templates/admin/footer');
            }
            // }
        }
        public function edit($id)
        {
            // $ci = get_instance();
            // if ($ci->session->userdata('id') != '8') {
            //     redirect('superadmin/');
            // } else {
            $transaksi = $this->Transaksi_model->getTransaksiById($id);
            $this->form_validation->set_rules('namatransaksi', 'Nama transaksi', 'required');
            $this->form_validation->set_rules('keterangantransaksi', 'Keterangan transaksi', 'required');
            $this->form_validation->set_rules('hargatransaksi', 'Harga transaksi', 'required');
            $this->form_validation->set_rules('stoktransaksi', 'Stok transaksi', 'required');
            // $this->form_validation->set_rules('fototransaksi', 'Foto transaksi', 'required');
            $this->form_validation->set_rules('kategori', 'Kategori transaksi', 'required');
            $this->form_validation->set_rules('umkm', 'UMKM transaksi', 'required');


            if ($this->form_validation->run() == true) {
                $db = [
                    'id_transaksi' => $id,
                    'nama_transaksi' => $this->input->post('namatransaksi'),
                    'keterangan_transaksi' => $this->input->post('keterangantransaksi'),
                    'harga_transaksi' => $this->input->post('hargatransaksi'),
                    'stok_transaksi' => $this->input->post('stoktransaksi'),
                    'fk_kategori' => $this->input->post('kategori'),
                    'fk_umkm' => $this->input->post('umkm')
                ];
                if ($_FILES["fototransaksi"]["name"] != "") {
                    $config['upload_path']          = './transaksi/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1000;

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('fototransaksi')) {
                        unlink(FCPATH . 'transaksi/' . $transaksi["foto_transaksi"]);
                        $db['foto_transaksi'] = $this->upload->data()["file_name"];
                    } else {
                        $this->session->set_flashdata('message_login', $this->flasher('danger', $this->upload->display_errors()));
                        var_dump($this->upload->display_errors());
                        die;
                        redirect('transaksi/edit/' . $id);
                    }
                }
                if ($this->transaksi_model->update($db) > 0) {
                    $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                } else {
                    $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                }
                redirect('transaksi/datatransaksi');
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('admin/transaksi/edittransaksi', ["transaksi" => $transaksi]);
                $this->load->view('templates/admin/footer');
            }
            // }
        }
        public function delete($id)
        {
            // $ci = get_instance();
            // if ($ci->session->userdata('id') != '8') {
            //     redirect('superadmin/');
            // } else {
            if ($id) {
                $transaksi = $this->Transaksi_model->getTransaksiById($id);
                $data = [
                    'transaksi' => $transaksi
                    // 'jenis' => $jenis
                ];
                echo $data;
                var_dump($data);
                die;
                // unlink(FCPATH . 'transaksi/' . $transaksi["foto_transaksi"]);

                if ($this->transaksi_model->delete($id) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
                }
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
            }
            redirect('transaksi/datatransaksi');
        }
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
