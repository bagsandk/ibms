<?php


class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        getMenu(1);
        getAccess($this->session->userdata('menuSelected'));
        // auth();
    }

    function index()
    {
        $data['title'] = 'Laporan';
        $data['_view'] = 'laporan/index';
        $data['_css'] = 'laporan/css';
        $data['_js'] = 'laporan/js';
        $this->load->view('layouts/main', $data);
    }
    function resume()
    {
        $data['title'] = 'RESUME PROGRESS INVESTASI PER JENIS KEGIATAN';
        $data['_view'] = 'laporan/resume/index';
        $data['_css'] = 'laporan/resume/css';
        $data['_js'] = 'laporan/resume/js';
        $this->load->view('layouts/main', $data);
    }
}
