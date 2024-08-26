<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    
    public function __construct()
    {

        parent::__construct();
        $this->load->model('employee/Common_model','common');
        //$this->load->model('employee/dashboard_model', 'Dashboard_model');
        ($this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);

    }

    function index()
    {
		$data['title'] = 'Dashboard';
        $data['breadcrumb'] = 'Dashboard';
        $this->load->view('employee/base', $data);
    }
    
}
