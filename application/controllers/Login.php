<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

        $username = $this->input->post('username');
        $passwd = $this->input->post('passwd');

        $user = $this->db->get_where('pelanggan', ['username_pelanggan' => $username])->row_array();

        if (isset($user)) {
            // var_dump($user);
            // die;
            if (password_verify($passwd, $user['password_pelanggan'])) {
                var_dump($user);
                die;
                $this->session->set_userdata('id', $user['id_pelanggan']);
                $this->session->set_userdata('username', $user['username_pelanggan']);
                $this->session->set_userdata('id_role', $user['fk_role']);
                if ($user['fk_role'] == '1') {
                    echo "<script>location.href='" . base_url('index.php/admin') . "';alert('Anda Berhasil Masuk Sebagai Admin');</script>";
                    // echo "<script>location.href='" . base_url('index.php/auth/dashboard') . "';alert('Anda Berhasil Masuk');</script>";
                } else if ($user['fk_role'] == '2') {
                    echo "<script>location.href='" . base_url('index.php/outlet') . "';alert('Anda Berhasil Masuk Sebagai Outlet');</script>";
                } else if ($user['fk_role'] == '3') {
                    echo "<script>location.href='" . base_url('index.php/superadmin') . "';alert('Anda Berhasil Masuk Sebagai Admin');</script>";
                } else {
                    echo "<script>location.href='" . base_url('index.php/agen') . "';alert('Anda Berhasil Masuk Sebagai Agen');</script>";
                }
            } else {
                // var_dump($user);
                // die;
                echo "<script>location.href='" . base_url('index.php/auth/login') . "';alert('Password Salah');</script>";
            }
        } else {
            redirect('index.php/auth/login');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email_cs]');
        $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run()) {
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
                    'fk_role' => '1',
                    'catatan' => 'input sendiri'
                ];

                if ($this->User_model->createUser($db) > 0) {
                    $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
                } else {
                    $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
                }
                echo "<script>location.href='" . base_url('index.php/login') . "';alert('Daftar Berhasil');</script>";
            }
        } else {
            echo "<script>location.href='" . base_url('index.php/login/formregister') . "';alert('Anda gagal Registrasi');</script>";
        }
    }
    public function formregister()
    {
        $this->load->view('auth/register');
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
            redirect('index.php/auth/');
        } else {
            $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been logged out'));
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('id_role');
            $this->session->unset_userdata('nama');
            echo "<script>alert('Anda Telah Keluar');</script>";
            redirect('index.php/auth/login');
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
