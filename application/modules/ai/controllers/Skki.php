<?php


class Skki extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // auth();
    }

    function index()
    {
        $data['title'] = 'skki';
        $data['_view'] = 'skki/index';
        $data['_css'] = 'skki/css';
        $data['_js'] = 'skki/js';
        $this->load->view('layouts/main', $data);
    }
    function get_data()
    {
        $this->load->helper('data_table_ssp');
        dataTable('user', ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user' => 'asc']);
    }
}
