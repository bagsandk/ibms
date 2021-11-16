<?php


class Realisasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // auth();
    }

    function index()
    {
        $data['title'] = 'Realisasi';
        $data['_view'] = 'realisasi/index';
        $data['_css'] = 'realisasi/css';
        $data['_js'] = 'realisasi/js';
        $this->load->view('layouts/main', $data);
    }
    function get_data()
    {
        $this->load->helper('data_table_ssp');
        dataTable('user', ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user' => 'asc']);
    }
}
