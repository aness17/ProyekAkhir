<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
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

        // $this->load->model('Transaksi_model');
        // $this->load->library('Pdf');
        // $this->load->library('Excel');

        // if (empty($this->session->userdata('id'))) {
        //     redirect('auth/login');
        // }

    }
    public function data()
    {
        $pelanggan = $this->User_model->selectAll();
        $data = [
            'pelanggan' => $pelanggan
        ];

        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/pelanggan/datapelanggan', $data);
        $this->load->view('templates/admin/footer');
        // }
    }
    public function add()
    {
        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->form_validation->set_rules('namapelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[pelanggan.username_pelanggan]');
        // $this->form_validation->set_rules('username', 'Username', 'required|valid_username|is_unique[pelanggan.username_pelanggan]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('notelp', 'No. Telp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == true) {
            //             $email = $this->input->post('email');
            //             $pos = strpos($email, "@gmail.com") ? "ada" : "tidak ada";
            //             if ($pos == "tidak ada") {
            //                 echo "<script>
            //     alert('harus gugel bund');
            //     history.go(-1);
            // </script>";
            //                 $this->session->set_flashdata('message_login', $this->flasher('danger', 'HARUS AKUN GUGEL'));
            //             } else {
            $db = [
                'nama_pelanggan' => $this->input->post('namapelanggan'),
                'username_pelanggan' => $this->input->post('username'),
                'password_pelanggan' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nohp_pelanggan' => $this->input->post('notelp'),
                'alamat_pelanggan' => $this->input->post('alamat'),
                'fk_role' => $this->input->post('role')
            ];

            // var_dump($db);

            if ($this->User_model->createpelanggan($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                redirect('pelanggan/data');
            } else {
                echo "Failed to create User";
                die;
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }

            // }
            // redirect('admin/pelanggan/tambahpelanggan');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/pelanggan/tambahpelanggan');
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
        $this->form_validation->set_rules('namapelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('notelp', 'No. Telp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        $pelanggan = $this->User_model->getpelangganById($id);
        $data = [
            'pelanggan' => $pelanggan
        ];
        if ($this->form_validation->run() == true) {

            $db = [
                "id_pelanggan" => $id,
                'nama_pelanggan' => $this->input->post('namapelanggan'),
                'username_pelanggan' => $this->input->post('username'),
                'nohp_pelanggan' => $this->input->post('notelp'),
                'alamat_pelanggan' => $this->input->post('alamat'),
                'fk_role' => $this->input->post('role')
            ];

            if ($this->User_model->updatepelanggan($db) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
            }
            redirect('pelanggan/data');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/pelanggan/editpelanggan', $data);
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
            if ($this->User_model->delete($id) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
            }
        } else {
            $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
        }
        redirect('pelanggan/datapelanggan');
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
