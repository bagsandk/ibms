<?php


class Prk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        getMenu($this->session->userdata('moduleSelected'));
        getAccess($this->session->userdata('menuSelected'));
    }

    function index()
    {
        $data['title'] = 'prk';
        $data['_view'] = 'prk/index';
        $data['_css'] = 'prk/css';
        $data['_js'] = 'prk/js';
        $this->load->view('layouts/main', $data);
    }
    function get_data()
    {
        $this->load->helper('data_table_ssp');
        dataTable('user', ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user', 'email', 'no_hp'], ['nama_user' => 'asc']);
    }
}
