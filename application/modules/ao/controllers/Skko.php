<?php


class Skko extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // auth();
        getAccess($this->session->userdata('menuSelected'));
    }

    function index()
    {
        $data['title'] = 'skko';
        $data['_view'] = 'skko/index';
        $data['_css'] = 'skko/css';
        $data['_js'] = 'skko/js';
        $this->load->view('layouts/main', $data);
    }
    function get_data()
    {
        $this->load->helper('data_table_ssp');
        if (isset($_POST['order'])) {
            $index = $_POST['order']['0']['column'];
            var_dump($_POST['columns'][$index]['name']);
        }
        dataTable('user', ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user' => 'asc']);
    }
}
