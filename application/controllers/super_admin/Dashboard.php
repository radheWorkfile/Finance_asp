<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('super_admin/common_model','Common_model');
        $this->load->model('super_admin/dashboard_model', 'Dashboard_model');
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }
    function index()
    {
       
        $data['title'] = 'Dashboard';
        $data['breadcrumb'] = 'Dashboard';
        $this->load->view('super_admin/base', $data);
    }
}
