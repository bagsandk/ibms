<?php


class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // auth();
    }

    function index()
    {
        $data['title'] = 'Home';
        $data['_view'] = 'home/index';
        $data['_css'] = 'home/css';
        $data['_js'] = 'home/js';
        $data['module'] = getModule();
        $this->load->view('layouts/main', $data);
    }
}
