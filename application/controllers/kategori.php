<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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

        $this->load->model('Kategori_model');

        // $this->load->model('Transaksi_model');
        // $this->load->library('Pdf');
        // $this->load->library('Excel');

        if (empty($this->session->userdata('id'))) {
            redirect('auth/login');
        }
    }
    public function datakategori()
    {
        $kategori = $this->Kategori_model->selectAll();
        $data = [
            'kategori' => $kategori
        ];

        $ci = get_instance();
        if ($ci->session->userdata('id') != '1') {
            redirect('admin/');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/kategori/datakategori', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    public function addkategori()
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '1') {
            redirect('admin/');
        } else {
            $this->form_validation->set_rules('namakategori', 'Nama Kategori', 'required');

            if ($this->form_validation->run() == true) {
                $config['upload_path']          = './kategori/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fotokategori')) {
                    $db = [
                        'nama_kategori' => $this->input->post('namakategori'),
                        'foto_kategori' => $this->upload->data()["file_name"],

                    ];

                    // var_dump($db);

                    if ($this->Kategori_model->create($db) > 0) {
                        $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                    } else {
                        $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                    }
                    redirect('kategori/datakategori');
                } else {
                    $this->session->set_flashdata('message_login', $this->flasher('danger', $this->upload->display_errors()));
                    redirect('kategori/datakategori');
                }
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('admin/kategori/tambahkategori');
                $this->load->view('templates/admin/footer');
            }
        }
    }

    public function edit($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '1') {
            redirect('admin/');
        } else {
            $this->form_validation->set_rules('namakategori', 'Nama Kategori', 'required');

            $kategori = $this->Kategori_model->getUserById($id);
            $data = [
                'kategori' => $kategori
            ];
            // if ($id == "") {
            if ($this->form_validation->run() == true) {
                $db = [
                    'id_kategori' => $id,
                    'nama_kategori' => $this->input->post('namakategori')
                ];
                if ($_FILES["fotokategori"]["name"] != "") {
                    $config['upload_path']          = './kategori/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1000;

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('fotokategori')) {
                        unlink(FCPATH . 'kategori/' . $kategori["foto_kategori"]);
                        $db['foto_kategori'] = $this->upload->data()["file_name"];
                    } else {
                        $this->session->set_flashdata('message_login', $this->flasher('danger', $this->upload->display_errors()));
                        var_dump($this->upload->display_errors());
                        die;
                        redirect('kategori/edit/' . $id);
                    }
                }
                if ($this->Kategori_model->update($db) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
                }
                redirect('kategori/datakategori');
            } else {
                $this->load->view('templates/admin/header');
                $this->load->view('templates/admin/sidebar');
                $this->load->view('admin/kategori/editkategori', $data);
                $this->load->view('templates/admin/footer');
            }
        }
    }
    public function delete($id)
    {
        $ci = get_instance();
        if ($ci->session->userdata('id') != '1') {
            redirect('admin/');
        } else {
            if ($id) {
                if ($this->Kategori_model->delete($id) > 0) {
                    $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
                } else {
                    $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
                }
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
            }
            redirect('kategori/datakategori');
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
