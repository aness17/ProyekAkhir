<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
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
    public function datacustomer()
    {
        $customer = $this->User_model->selectAll();
        $data = [
            'customer' => $customer
        ];

        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/customer/datacustomer', $data);
        $this->load->view('templates/admin/footer');
        // }
    }
    public function addcustomer()
    {
        // $ci = get_instance();
        // if ($ci->session->userdata('id') != '8') {
        //     redirect('superadmin/');
        // } else {
        $this->form_validation->set_rules('namapelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('username', 'Username', 'xss_clean|is_unique[pelanggan.username_pelanggan]');
        // $this->form_validation->set_rules('username', 'Username', 'required|valid_username|is_unique[pelanggan.username_pelanggan]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nohp', 'No. Telp', 'required');
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
                'nohp_pelanggan' => $this->input->post('nohp'),
                'alamat_pelanggan' => $this->input->post('alamat'),
                'fk_role' => $this->input->post('id_role')
            ];

            // var_dump($db);

            if ($this->User_model->createUser($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }

            redirect('customer/datacustomer');

            // }
            // redirect('admin/customer/tambahcustomer');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('admin/customer/tambahcustomer');
            $this->load->view('templates/admin/footer');
        }
        // }
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
