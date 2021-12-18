<?php


class Kontrak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // auth();
    }

    function index()
    {
        $data['title'] = 'Kontrak';
        $data['_view'] = 'kontrak/index';
        $data['_css'] = 'kontrak/css';
        $data['_js'] = 'kontrak/js';
        $this->load->view('layouts/main', $data);
    }
    function get_data()
    {
        $this->load->helper('data_table_ssp');
        dataTable('user', ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user' => 'asc']);
    }
}
