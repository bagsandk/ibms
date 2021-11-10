<?php


class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // auth();
    }

    function index()
    {
        $data['title'] = 'Dashboard';
        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main', $data);
    }
}
