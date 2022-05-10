<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Umkm extends CI_Controller
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

        $this->load->model('Umkm_model');

        // $this->load->model('Transaksi_model');
        // $this->load->library('Pdf');
        // $this->load->library('Excel');

        // if (empty($this->session->userdata('id'))) {
        //     redirect('auth/login');
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
        $this->load->view('admin/umkm/dataumkm', $data);
        $this->load->view('templates/admin/footer');
        // }
    }
    public function addumkm()
    {
        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->form_validation->set_rules('namaumkm', 'Nama UMKM', 'required');

        if ($this->form_validation->run() == true) {
            $db = [
                'nama_umkm' => $this->input->post('namaumkm'),
            ];

            // var_dump($db);

            if ($this->Umkm_model->create($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }
            redirect('umkm/dataumkm');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/umkm/tambahumkm');
            $this->load->view('templates/admin/footer');
        }
    }
    // }

    public function edit($id)
    {
        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->form_validation->set_rules('namaumkm', 'Nama UMKM', 'required');

        $umkm = $this->Umkm_model->getUserById($id);
        $data = [
            'umkm' => $umkm
        ];
        // if ($id == "") {
        if ($this->form_validation->run() == true) {
            $db = [
                'id_umkm' => $id,
                'nama_umkm' => $this->input->post('namaumkm')
            ];

            if ($this->Umkm_model->update($db) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
            }
            redirect('umkm/dataumkm');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/umkm/editumkm', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    // }
    public function delete($id)
    {
        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        if ($id) {
            if ($this->Umkm_model->delete($id) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
            }
        } else {
            $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
        }
        redirect('umkm/dataumkm');
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
