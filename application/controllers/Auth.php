<?php
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
        if ($this->form_validation->run()) {
            $username =  $this->input->post('username');
            $password =  $this->input->post('password');
            $user = $this->db->get_where('user', ['email' => $username])->row_array();
            if ($user) {
                if ($user['aktif'] == 0) {
                    snackBar("danger", "Akun Belum aktif! ");
                    redirect('auth');
                }
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'id_user' => $user['id_user'],
                        'foto' => $user['foto'],
                        'no_hp' => $user['no_hp'],
                        'nama' => $user['nama_user'],
                        'gambar' => $user['gambar'],
                        'role' => $user['role']
                    ];
                    snackBar('success', "Hay " . $user['nama_user']);
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    snackBar("danger", "Maaf password yang anda masukan salah! ");
                    redirect('auth');
                }
            } else {
                snackBar("danger", "Akun Tidak Terdaftar");
                redirect('auth');
            }
        } else {
            $data['title'] = "Login";
            $data['_view'] = 'auth/login';
            $this->load->view('layouts/main_login', $data);
        }
    }
    function register()
    {
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|max_length[50]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        if ($this->form_validation->run()) {
            if ($this->db->get_where('user', ['email' => $this->input->post('email')])->row_array()) {
                snackBar('danger', 'Email sudah digunakan!');
                redirect('auth/daftar');
            }
            if ($this->db->get_where('user', ['no_hp' => $this->input->post('no_hp')])->row_array()) {
                snackBar('danger', 'Nomor sudah digunakan!');
                redirect('auth/daftar');
            }
            $params1 = array(
                'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 'user',
                'email' => $this->input->post('email'),
                'gambar' => 'default.png',
                'aktif' => '0',
                'no_hp' =>  $this->input->post('no_hp'),
                'nama_user' => $this->input->post('nama'),
            );
            $id = $this->User_model->add_user($params1);
            snackBar('success', 'Pendaftaran berhasil, akun akan di verifikasi!');
            redirect('auth/');
        } else {
            $data['_view'] = 'auth/register';
            $data['title'] = 'Registrasi akun';
            $this->load->view('layouts/main_login', $data);
        }
    }
    function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('no_hp');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('soal');
        $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Anda berhasil logout! </div>');
        redirect('auth');
    }
}
