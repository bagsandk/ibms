<?php


class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        auth();
    }

    /*
     * Listing of user_
     */
    function index()
    {
        $data['user'] = $this->User_model->get_all_user();
        $data['_view'] = 'user/index';
        $data['title'] = 'Daftar User';
        $this->load->view('layouts/main', $data);
    }

    /*
     * Adding a new user
     */
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|valid_email');
        $this->form_validation->set_rules('hp', 'Hp', 'required|max_length[14]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run()) {
            $params = array(
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama_user' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('hp'),
                'foto' => 'default.png',
            );
            $user_id = $this->User_model->add_user($params);
            $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>user Berhasil Di Tambah </div>');
            redirect('user/index');
        } else {
            $data['title'] = 'Tambah User';
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Editing a user
     */
    function edit($id)
    {
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id);

        if (isset($data['user']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|valid_email');
            $this->form_validation->set_rules('hp', 'Hp', 'required|max_length[14]');
            $this->form_validation->set_rules('nama', 'Nama', 'required');

            if ($this->form_validation->run()) {
                if ($this->input->post('password')) {
                    $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');
                    $pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                } else {
                    $pass = $data['user']['password'];
                }
                $params = array(
                    'password' => $pass,
                    'nama_user' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                    'no_hp' => $this->input->post('hp'),
                );

                $this->User_model->update_user($id, $params);
                $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>user Berhasil Di Edit </div>');
                redirect('user/index');
            } else {
                $data['title'] = 'Edit User';
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The user you are trying to edit does not exist.');
    }

    /*
     * Deleting user
     */
    function remove($id)
    {
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if (isset($user['id'])) {
            $this->User_model->delete_user($id);
            $this->session->set_flashdata('message', '<div class="alert alert-dismissible bg-success text-white border-0 fade show text-capitalize" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>user Berhasil Di Hapus </div>');
            redirect('user/index');
        } else
            show_error('The user you are trying to delete does not exist.');
    }
}
