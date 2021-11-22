<?php

use GuzzleHttp\Exception\ClientException;

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
            // $username =  $this->input->post('username');
            // $password =  $this->input->post('password');
            // $user = $this->db->get_where('user', ['email' => $username])->row_array();
            // if ($user) {
            //     if ($user['aktif'] == 0) {
            //         snackBar("danger", "Akun Belum aktif! ");
            //         redirect('auth');
            //     }
            //     if (password_verify($password, $user['password'])) {
            //         $data = [
            //             'email' => $user['email'],
            //             'id_user' => $user['id_user'],
            //             'foto' => $user['foto'],
            //             'no_hp' => $user['no_hp'],
            //             'nama' => $user['nama_user'],
            //             'gambar' => $user['gambar'],
            //             'role' => $user['role']
            //         ];
            //         snackBar('success', "Hay " . $user['nama_user']);
            //         $this->session->set_userdata($data);
            //         redirect('dashboard');
            //     } else {
            //         snackBar("danger", "Maaf password yang anda masukan salah! ");
            //         redirect('auth');
            //     }
            // } else {
            //     snackBar("danger", "Akun Tidak Terdaftar");
            //     redirect('auth');
            // }
            $client = new GuzzleHttp\Client(['base_uri' => IP_BACKEND]);
            try {
                $response = $client->post('Auth/SignIn', [
                    'form_params' => [
                        'Email' => 'dikirahmadsandi@outlook.com',
                        'Password' => '123',
                    ]
                ]);
                $body = $response->getBody();
                $content = json_decode($body->getContents());
                $this->session->set_userdata('accessToken', $content->data->accessToken);
                $this->session->set_userdata('refreshToken', $content->data->refreshToken);
                try {
                    $response2 = $client->request('GET', 'Access/GetListAccess', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $content->data->accessToken,
                        ]
                    ]);
                    $body2 = $response2->getBody();
                    $content2 = json_decode($body2->getContents());
                    $this->session->set_userdata('dataAccess', $content2->data);
                    $this->session->set_userdata('moduleSelected', '');
                    $this->session->set_userdata('menuSelected', '');

                    redirect('home');
                } catch (ClientException $e) {
                    json_decode($e->getResponse()->getBody()->getContents());
                    redirect('auth');
                }
            } catch (ClientException $e) {
                json_decode($e->getResponse()->getBody()->getContents());
                redirect('auth');
            }
        } else {
            $data['title'] = "Login";
            $data['_view'] = 'auth/login';
            $this->load->view('layouts/main_login', $data);
        }
    }


    function setSession()
    {
        $accessToken =  $this->input->post('accessToken');
        $refreshToken =  $this->input->post('refreshToken');
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
