<?php


class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        getMenu(2);
        getAccess($this->session->userdata('menuSelected'));
    }

    function index()
    {
        $data['title'] = 'Dashboard';
        $data['_view'] = 'dashboard/index';
        $data['_css'] = 'dashboard/css';
        $data['_js'] = 'dashboard/js';
        $this->load->view('layouts/main', $data);
    }
}
